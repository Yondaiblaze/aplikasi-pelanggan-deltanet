<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Get all app settings (public endpoint, no auth needed)
     */
    public function index()
    {
        try {
            $settings = Setting::all()->mapWithKeys(function ($item) {
                return [$item->key => [
                    'value' => $item->value,
                    'type' => $item->type,
                ]];
            });

            return api_success('settings.fetch_success', [
                'settings' => $settings,
                'locale_supported' => get_supported_locales(),
                'locale_names' => get_locale_names(),
                'current_locale' => get_current_locale(),
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to fetch settings: ' . $e->getMessage());
            return api_error('settings.fetch_failed', null, 500);
        }
    }

    /**
     * Get theme colors only
     */
    public function getTheme()
    {
        try {
            $colors = [
                'primary' => Setting::getValue('primary_color', '#0066cc'),
                'secondary' => Setting::getValue('secondary_color', '#6c757d'),
                'success' => Setting::getValue('success_color', '#28a745'),
                'danger' => Setting::getValue('danger_color', '#dc3545'),
                'warning' => Setting::getValue('warning_color', '#ffc107'),
                'info' => Setting::getValue('info_color', '#17a2b8'),
            ];

            return api_success('settings.theme_retrieved', [
                'colors' => $colors,
                'locale' => get_current_locale()
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to fetch theme: ' . $e->getMessage());
            return api_error('settings.fetch_failed', null, 500);
        }
    }

    /**
     * Get specific setting by key (admin endpoint)
     */
    public function show($key)
    {
        try {
            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                return api_error('settings.not_found', null, 404);
            }

            return api_success('settings.fetch_success', [
                'key' => $setting->key,
                'value' => $setting->value,
                'type' => $setting->type,
                'description' => $setting->description,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to fetch setting: ' . $e->getMessage());
            return api_error('settings.fetch_failed', null, 500);
        }
    }

    /**
     * Update setting (admin endpoint, requires auth)
     */
    public function update(Request $request, $key)
    {
        $this->validate($request, [
            'value' => 'required',
            'type' => 'sometimes|in:string,boolean,integer,color,json'
        ]);

        try {
            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                return api_error('settings.not_found', null, 404);
            }

            $setting->update([
                'value' => $request->value,
                'type' => $request->type ?? $setting->type,
            ]);

            return api_success('settings.update_success', [
                'key' => $setting->key,
                'value' => $setting->value,
                'type' => $setting->type,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to update setting: ' . $e->getMessage());
            return api_error('settings.update_failed', null, 500);
        }
    }
}
