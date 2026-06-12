<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function orders()
    {
        $orders = Order::with('assignedDriver')
            ->latest()
            ->get();

        $stats = [
            'total'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'active'    => $orders->whereIn('status', ['driver_assigned', 'in_progress'])->count(),
            'completed' => $orders->where('status', 'completed')->count(),
        ];

        return view('admin.orders', compact('orders', 'stats'));
    }

    public function drivers()
    {
        // Single optimized query — no N+1
        $drivers = Driver::with('district')
            ->orderByRaw("FIELD(status, 'available', 'busy', 'offline')")
            ->get();

        // Get active orders in one query
        $activeOrders = Order::whereIn('status', ['driver_assigned', 'in_progress'])
            ->whereNotNull('assigned_driver_id')
            ->get()
            ->keyBy('assigned_driver_id');

        foreach ($drivers as $driver) {
            $driver->active_order = $activeOrders->get($driver->id);
        }

        $stats = [
            'total'     => $drivers->count(),
            'available' => $drivers->where('status', 'available')->count(),
            'busy'      => $drivers->where('status', 'busy')->count(),
            'offline'   => $drivers->where('status', 'offline')->count(),
        ];

        return view('admin.drivers', compact('drivers', 'stats'));
    }

    public function setDriverStatus(Request $request, Driver $driver)
    {
        $request->validate(['status' => 'required|in:available,busy,offline']);
        $driver->update(['status' => $request->status]);
        return redirect('/admin/drivers')->with('success', "✅ {$driver->name} set to {$request->status}.");
    }

    public function createDriver(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'phone'       => 'required|string|max:20|unique:drivers,phone',
            'password'    => 'required|string|min:6',
            'district_id' => 'required|exists:districts,id',
        ]);

        Driver::create([
            'name'        => $validated['name'],
            'phone'       => $validated['phone'],
            'password'    => Hash::make($validated['password']),
            'district_id' => $validated['district_id'],
            'status'      => 'available',
        ]);

        return redirect('/admin/drivers')
            ->with('success', "✅ Driver {$validated['name']} created successfully.");
    }

    public function quickCreateDriver(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
        ]);

        $phone = '09' . rand(1000000, 9999999);

        // Ensure unique phone
        while (Driver::where('phone', $phone)->exists()) {
            $phone = '09' . rand(1000000, 9999999);
        }

        $district = District::find($request->district_id);

        $driver = Driver::create([
            'name'        => 'Demo Driver ' . substr($phone, -4),
            'phone'       => $phone,
            'password'    => Hash::make('password123'),
            'district_id' => $request->district_id,
            'status'      => 'available',
        ]);

        return redirect('/admin/drivers')
            ->with('success', "⚡ Quick driver created: {$driver->name} | Phone: {$phone} | Password: password123 | District: {$district->name_en}");
    }

    public function deleteDriver(Driver $driver)
    {
        $driver->delete();
        return redirect('/admin/drivers')
            ->with('success', "🗑 Driver {$driver->name} deleted.");
    }
}