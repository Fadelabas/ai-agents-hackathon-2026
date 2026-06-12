<?php

namespace App\Services;

use App\Models\District;
use App\Models\Driver;
use App\Models\DriverOffer;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class DriverAssignmentService
{
    /**
     * Assign driver using fallback chain:
     * same district → same governorate → any available
     */
    public function assign(Order $order): ?DriverOffer
    {
        $driver = $this->findDriver($order);

        if (!$driver) {
            return null;
        }

        $offer = DriverOffer::create([
            'order_id'   => $order->id,
            'driver_id'  => $driver->id,
            'status'     => DriverOffer::STATUS_PENDING,
            'offered_at' => now(),
        ]);

        $driver->update(['status' => 'busy']);

        return $offer;
    }

    /**
     * Find best available driver using fallback chain.
     */
    private function findDriver(Order $order): ?Driver
    {
        // ── Level 1: Same district ────────────────────────────
        if ($order->district_id) {
            $driver = Driver::where('district_id', $order->district_id)
                ->where('status', 'available')
                ->first();

            if ($driver) {
                Log::info("Jibli: Driver assigned from district [{$order->district_name}]", [
                    'driver' => $driver->name,
                    'order'  => $order->id,
                ]);
                return $driver;
            }
        }

        // ── Level 2: Same governorate ─────────────────────────
        if ($order->governorate_id) {
            $districtIds = District::where('governorate_id', $order->governorate_id)
    ->pluck('id');

            $driver = Driver::whereIn('district_id', $districtIds)
                ->where('status', 'available')
                ->first();

            if ($driver) {
                Log::info("Jibli: Driver assigned from governorate [{$order->governorate_name}]", [
                    'driver' => $driver->name,
                    'order'  => $order->id,
                ]);
                return $driver;
            }
        }

        // ── Level 3: Any available driver ─────────────────────
        $driver = Driver::where('status', 'available')->first();

        if ($driver) {
            Log::info("Jibli: Driver assigned from global pool", [
                'driver' => $driver->name,
                'order'  => $order->id,
            ]);
            return $driver;
        }

        Log::warning("Jibli: No available driver found for order [{$order->id}]");
        return null;
    }

    
    /**
     * Driver accepts the offer.
     */
    public function accept(DriverOffer $offer): void
    {
        $offer->update([
            'status'       => DriverOffer::STATUS_ACCEPTED,
            'responded_at' => now(),
        ]);

        $offer->order->update([
            'status'             => Order::STATUS_DRIVER_ASSIGNED,
            'assigned_driver_id' => $offer->driver_id,
        ]);
    }

    /**
     * Driver rejects — try next driver in fallback chain.
     */
    public function reject(DriverOffer $offer): ?DriverOffer
    {
        $offer->update([
            'status'       => DriverOffer::STATUS_REJECTED,
            'responded_at' => now(),
        ]);

        $offer->driver->update(['status' => 'available']);

        // Exclude all already-tried drivers
        $triedIds = DriverOffer::where('order_id', $offer->order_id)
            ->pluck('driver_id')
            ->toArray();

        $order = $offer->order;

        // Try district first
        $next = null;

        if ($order->district_id) {
            $next = Driver::where('district_id', $order->district_id)
                ->where('status', 'available')
                ->whereNotIn('id', $triedIds)
                ->first();
        }

        // Try governorate
        if (!$next && $order->governorate_id) {
            $districtIds = \App\Models\District::where('governorate_id', $order->governorate_id)
                ->pluck('id');

            $next = Driver::whereIn('district_id', $districtIds)
                ->where('status', 'available')
                ->whereNotIn('id', $triedIds)
                ->first();
        }

        // Try any available
        if (!$next) {
            $next = Driver::where('status', 'available')
                ->whereNotIn('id', $triedIds)
                ->first();
        }

        if (!$next) {
            return null;
        }

        $newOffer = DriverOffer::create([
            'order_id'   => $offer->order_id,
            'driver_id'  => $next->id,
            'status'     => DriverOffer::STATUS_PENDING,
            'offered_at' => now(),
        ]);

        $next->update(['status' => 'busy']);

        return $newOffer;
    }

    /**
     * Driver completes the order.
     */
    public function complete(DriverOffer $offer): void
    {
        $offer->update([
            'status'       => DriverOffer::STATUS_ACCEPTED,
            'responded_at' => now(),
        ]);

        $offer->order->update([
            'status' => Order::STATUS_COMPLETED,
        ]);

        $offer->driver->update(['status' => 'available']);
    }
}