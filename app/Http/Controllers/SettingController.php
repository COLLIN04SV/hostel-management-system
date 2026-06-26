<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'system_name' => 'Hostel Management System'
            ]);
        }

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $setting->update($request->only([
            'system_name',
            'email',
            'phone',
            'address'
        ]));

        return redirect()
            ->route('settings.index')
            ->with('success', 'Settings updated successfully');
    }
}