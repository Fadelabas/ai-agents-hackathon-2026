<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverOffer;
use App\Models\Order;
use App\Services\DriverAssignmentService;

class DashboardController extends Controller
{
    public function __construct(
        private DriverAssignmentService $assignment
    ) {}

   public function index()
{
    $driver = Driver::find(session('driver_id'));

    if (!$driver) {
        session()->forget('driver_id');
        return redirect()->route('driver.login')
            ->with('error', 'Session expired. Please log in again.');
    }

    // Only pending offers
    $pendingOffer = DriverOffer::where('driver_id', $driver->id)
        ->where('status', 'pending')
        ->with('order')
        ->latest()
        ->first();

    // Only active accepted orders (not completed)
    $activeOffer = DriverOffer::where('driver_id', $driver->id)
        ->where('status', 'accepted')
        ->whereHas('order', function ($q) {
            $q->whereIn('status', ['driver_assigned', 'in_progress']);
        })
        ->with('order')
        ->latest()
        ->first();

    return view('driver.dashboard', compact('driver', 'pendingOffer', 'activeOffer'));
}
    public function accept(DriverOffer $offer)
    {
        if ($offer->driver_id !== session('driver_id')) {
            abort(403);
        }

        $this->assignment->accept($offer);

        return redirect()->route('driver.dashboard');
    }

    public function reject(DriverOffer $offer)
    {
        if ($offer->driver_id !== session('driver_id')) {
            abort(403);
        }

        $this->assignment->reject($offer);

        return redirect()->route('driver.dashboard');
    }

  public function complete(Order $order)
{
    $offer = DriverOffer::where('order_id', $order->id)
        ->where('driver_id', session('driver_id'))
        ->where('status', 'accepted')
        ->firstOrFail();

    // Complete the order
    $this->assignment->complete($offer);

    return redirect()->route('driver.dashboard')
        ->with('success', 'Order marked as completed.');
}
}