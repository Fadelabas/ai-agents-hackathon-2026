<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('driver_id')) {
            return redirect()->route('driver.dashboard');
        }
        return view('driver.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone'    => 'required|string',
            'password' => 'required|string',
        ]);

        $driver = Driver::where('phone', $request->phone)->first();

        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return back()->withErrors(['phone' => 'Invalid phone or password.']);
        }

        session(['driver_id' => $driver->id]);

        return redirect()->route('driver.dashboard');
    }

   public function logout()
{
    session()->forget('driver_id');
    return redirect()->route('driver.login')->with('success', 'You have been logged out.');
}
}