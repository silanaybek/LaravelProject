<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = ['site_name', 'site_description', 'site_email', 'site_phone', 'site_address', 'facebook', 'instagram', 'twitter'];
        foreach ($fields as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
        }
        return back()->with('success', 'Ayarlar kaydedildi.');
    }
}
