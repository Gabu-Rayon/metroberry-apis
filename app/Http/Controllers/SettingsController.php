<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function fuelingSetting()
    {
        return view('settings.general-settings.fuel-setting');
    }
    public function maintenanceSetting()
    {
        return view('settings.general-settings.maintenance-setting');
    }
    public function generalSetting()
    {
        return view('settings.general-settings.setting');
    }
    public function envSetting()
    {
        return view('settings.env');
    }
    public function languageSetting()
    {
        return view('settings.language');
    }
    public function mailSetting()
    {
        return view('settings.mail');
    }

    public function siteSetting()
    {
        return view('settings.site');
    }


    public function siteSettingUpdate(Request $request)
    {
        $request->validate([
            'site_url' => 'required|url',
            'site_name' => 'required|string|max:255',
            'app_description' => 'nullable|string',
            'data.4' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', 
            'data.5' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', 
            'data.6' => 'nullable|image|mimes:ico,png|max:2048',
        ]);




        // Update configuration values
        Config::set('app.url', $request->input('site_url'));
        Config::set('app.name', $request->input('site_name'));
        Config::set('app.description', $request->input('app_description'));

        // Update site settings
        SiteSetting::updateOrCreate(['key' => 'site.url'], ['value' => $request->input('site_url')]);
        SiteSetting::updateOrCreate(['key' => 'site.name'], ['value' => $request->input('site_name')]);
        SiteSetting::updateOrCreate(['key' => 'app.description'], ['value' => $request->input('app_description')]);
   
        // Handle file uploads
        $data = $request->all();

        if ($request->hasFile('data.4')) {
            $logoWhite = $request->file('data.4')->store('logos', 'public');
            SiteSetting::updateOrCreate(['key' => 'site.logo_light'], ['value' => $logoWhite]);
        }

        if ($request->hasFile('data.5')) {
            $logoBlack = $request->file('data.5')->store('logos', 'public');
            SiteSetting::updateOrCreate(['key' => 'site.logo_black'], ['value' => $logoBlack]);
        }

        if ($request->hasFile('data.6')) {
            $favicon = $request->file('data.6')->store('favicons', 'public');
            SiteSetting::updateOrCreate(['key' => 'site.favicon'], ['value' => $favicon]);
        }

        // Update .env file if necessary
        $envFilePath = base_path('.env');
        if (File::exists($envFilePath)) {
            $envContent = File::get($envFilePath);
            $envContent = preg_replace('/^APP_URL=.*$/m', 'APP_URL=' . $request->input('site_url'), $envContent);
            File::put($envFilePath, $envContent);
        }

        // Flash message and redirect
        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }

}