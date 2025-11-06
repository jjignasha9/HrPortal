<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $data = [
            'site_title' => Setting::get('site_title', config('app.name')),
            'theme_color' => Setting::get('theme_color', '#0ea5e9'),
            'logo_path' => Setting::get('logo_path'),
            'mail_host' => Setting::get('mail_host'),
            'mail_port' => Setting::get('mail_port'),
            'mail_username' => Setting::get('mail_username'),
        ];
        return view('settings.index', compact('data'));
    }

    public function update(Request $request, string $id = null)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:150',
            'theme_color' => 'required|string|max:20',
            'logo' => 'nullable|image|max:2048',
            'mail_host' => 'nullable|string|max:150',
            'mail_port' => 'nullable|numeric',
            'mail_username' => 'nullable|string|max:150',
        ]);

        foreach (['site_title','theme_color','mail_host','mail_port','mail_username'] as $k) {
            if (array_key_exists($k, $validated)) {
                Setting::updateOrCreate(['key' => $k], ['value' => (string)$validated[$k]]);
                cache()->forget("setting_{$k}");
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            if ($old = Setting::get('logo_path')) Storage::disk('public')->delete($old);
            Setting::updateOrCreate(['key' => 'logo_path'], ['value' => $path]);
            cache()->forget('setting_logo_path');
        }

        return back()->with('status','Settings saved');
    }
}
