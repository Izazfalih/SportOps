<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class AdminSettingController extends Controller
{
    public function index()
    {
        $venue = Venue::first();
        if (!$venue) {
            $venue = Venue::create([
                'nama_venue' => 'SportOps Arena',
                'alamat' => 'Jl. Olahraga No. 123, Jakarta Selatan',
                'kontak' => '0812-3456-7890',
                'open_time' => '08:00',
                'close_time' => '23:00',
                'dp_percentage' => 50,
                'payment_expiry' => '1_hour',
                'notif_new_booking' => 1,
                'notif_payment' => 1,
                'notif_cancel' => 0,
                'merchant_name' => 'SportOps Arena'
            ]);
        }

        return view('admin.settings', compact('venue'));
    }

    public function update(Request $request)
    {
        $venue = Venue::first();

        // 1. General Settings Form
        if ($request->has('form_type') && $request->form_type === 'general') {
            $request->validate([
                'nama_venue' => 'required|string|max:255',
                'kontak' => 'required|string|max:50',
                'alamat' => 'required|string',
                'open_time' => 'required',
                'close_time' => 'required',
            ]);

            $venue->update([
                'nama_venue' => $request->nama_venue,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
                'open_time' => $request->open_time,
                'close_time' => $request->close_time,
            ]);

            return redirect()->back()->with('success', 'General settings updated successfully.');
        }

        // 2. Payment Settings Form
        if ($request->has('form_type') && $request->form_type === 'payment') {
            $request->validate([
                'merchant_name' => 'required|string|max:255',
                'dp_percentage' => 'required|integer|min:0|max:100',
                'payment_expiry' => 'required|string',
            ]);

            $venue->update([
                'merchant_name' => $request->merchant_name,
                'dp_percentage' => $request->dp_percentage,
                'payment_expiry' => $request->payment_expiry,
            ]);

            return redirect()->back()->with('success', 'Payment settings updated successfully.');
        }

        // 3. Notification Settings Form
        if ($request->has('form_type') && $request->form_type === 'notification') {
            $venue->update([
                'notif_new_booking' => $request->has('notif_new_booking'),
                'notif_payment' => $request->has('notif_payment'),
                'notif_cancel' => $request->has('notif_cancel'),
            ]);

            return redirect()->back()->with('success', 'Notification settings updated successfully.');
        }

        return redirect()->back();
    }
}
