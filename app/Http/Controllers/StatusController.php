<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function show(string $token)
{
    $order = Order::where('session_token', $token)
        ->with('assignedDriver')
        ->first();

    if (!$order) {
        return response()->json(['status' => 'not_found']);
    }

    return response()->json([
        'status'            => $order->status,
        'price'             => $order->price,
        'order_description' => $order->order_description,
        'driver_name'       => $order->assignedDriver?->name,
        'driver_phone'      => $order->assignedDriver?->phone,
    ]);
}
}