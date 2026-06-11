<?php

namespace App\Services;

use App\Models\Driver;
use App\Models\DriverOffer;
use App\Models\Order;

class DriverAssignmentService
{
    /**
     * Find available driver in same district and create offer.
     */
    public function assign(Order $order): ?DriverOffer
    {
        if (!$order->district_id) {
            return null;
        }

        $driver = Driver::where('district_id', $order->district_id)
            ->where('status', 'available')
            ->first();

        if (!$driver) {
            return null;
        }

        // Create the offer
        $offer = DriverOffer::create([
            'order_id'   => $order->id,
            'driver_id'  => $driver->id,
            'status'     => DriverOffer::STATUS_PENDING,
            'offered_at' => now(),
        ]);

        // Mark driver as busy
        $driver->update(['status' => 'busy']);

        return $offer;
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
     * Driver rejects the offer.
     * Tries to assign next available driver.
     */
    public function reject(DriverOffer $offer): ?DriverOffer
    {
        $offer->update([
            'status'       => DriverOffer::STATUS_REJECTED,
            'responded_at' => now(),
        ]);

        // Free the driver
        $offer->driver->update(['status' => 'available']);

        // Try next driver — exclude already tried drivers
        $triedDriverIds = DriverOffer::where('order_id', $offer->order_id)
            ->pluck('driver_id')
            ->toArray();

        $nextDriver = Driver::where('district_id', $offer->order->district_id)
            ->where('status', 'available')
            ->whereNotIn('id', $triedDriverIds)
            ->first();

        if (!$nextDriver) {
            return null;
        }

        $newOffer = DriverOffer::create([
            'order_id'   => $offer->order_id,
            'driver_id'  => $nextDriver->id,
            'status'     => DriverOffer::STATUS_PENDING,
            'offered_at' => now(),
        ]);

        $nextDriver->update(['status' => 'busy']);

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