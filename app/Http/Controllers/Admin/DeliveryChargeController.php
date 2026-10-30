<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::getAll();
        return view('admin.delivery_charge.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'shipping_inside_dhaka' => 'required|numeric|min:0',
            'shipping_outside_dhaka' => 'required|numeric|min:0',
            'free_shipping_threshold' => 'required|numeric|min:0',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Clear cache
        \Illuminate\Support\Facades\Cache::forget('site_settings');

        return redirect()->route('admin.delivery-charge.index')->with('success', 'Delivery charges updated successfully.');
    }
}
