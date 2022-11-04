<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $address = Setting::where('key', 'rajaongkir_address')->first();
        return view('dashboard.setting.index', compact('address'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'origin' => 'required'
        ]);
        DB::transaction(function () use ($request) {
            $address = Setting::where('key', 'rajaongkir_address')->first();
            $address->value = $request->address;
            $address->save();

            $origin = Setting::where('key', 'rajaongkir_origin')->first();
            $origin->value = $request->origin;
            $origin->save();
        });
        return redirect()->route('dashboard.setting.index');
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required'
        ]);
        $setting->update([
            'value' => $request->value
        ]);
        return redirect()->back()->with('success', 'Setting updated successfully');
    }
}
