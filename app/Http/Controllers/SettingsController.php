<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    // Get all settings from cache or defaults
    private function getSettings()
    {
        return Cache::remember('site_settings', now()->addDays(30), function () {
            return [
                'site_name' => 'My Shop',
                'site_email' => 'info@myshop.com',
                'site_phone' => '',
                'currency' => 'EGP',
                'shipping_cost' => 50,
                'tax_rate' => 0,
                'dark_mode_enabled' => true,
                'dark_mode_default' => false,
                'respect_system_preference' => true,
                'dark_mode_scheme' => 'dark-navy',
                'maintenance_mode' => false,
                'user_registration' => true,
                'reviews_enabled' => true,
                'video_section' => true,
                'multi_language' => true,
                'guest_checkout' => false,
                // Security
                'two_factor_enabled' => false,
                'login_attempt_limit' => true,
                'session_timeout' => true,
                'strong_password' => true,
                'ssl.https' => true,
                // Payment
                'cod_enabled' => true,
                'card_enabled' => false,
                'vodafone_cash_enabled' => false,
                'paypal_enabled' => false,
                // Email
                'order_confirmation_email' => true,
                'order_status_email' => true,
                'welcome_email' => false,
                'password_reset_email' => true,
                'email_from_name' => 'My Shop',
                'email_from_address' => 'noreply@myshop.com',
            ];
        });
    }

    public function index()
    {
        $settings = $this->getSettings();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
       $settings = $request->except(['_token', 'logo']);
       if ($request->hasFile('logo')) {
    $settings['logo'] = $request->file('logo')->store('logos', 'public');  }

        // Handle checkboxes (they send 'on' or nothing)
        $checkboxes = [
            'dark_mode_enabled', 'dark_mode_default', 'respect_system_preference',
            'user_registration', 'reviews_enabled', 'video_section', 'multi_language', 'guest_checkout',
            'two_factor_enabled', 'login_attempt_limit', 'session_timeout', 'strong_password', 'ssl.https',
            'cod_enabled', 'card_enabled', 'vodafone_cash_enabled', 'paypal_enabled',
            'order_confirmation_email', 'order_status_email', 'welcome_email', 'password_reset_email',
        ];

        foreach ($checkboxes as $key) {
            $settings[$key] = $request->has($key) ? true : false;
        }

        // Handle maintenance mode separately
        if ($request->has('maintenance_mode') && $request->maintenance_mode) {
            Artisan::call('down', ['--render' => '503']);
        } else {
            Artisan::call('up');
        }

        Cache::put('site_settings', $settings, now()->addDays(365));
        Cache::put('dark_mode_enabled', $settings['dark_mode_enabled'] ?? true, now()->addDays(365));
        Cache::put('maintenance_mode', $settings['maintenance_mode'] ?? false, now()->addDays(365));

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }

    public function toggleSetting(Request $request)
    {
        $key = $request->key;
        $settings = $this->getSettings();
        $settings[$key] = !$settings[$key];
        Cache::put('site_settings', $settings, now()->addDays(365));

        return response()->json([
            'success' => true,
            'key' => $key,
            'value' => $settings[$key]
        ]);
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return redirect()->back()->with('success', 'Cache cleared successfully!');
    }

    public function optimize()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        Artisan::call('optimize');

        return redirect()->back()->with('success', 'Application optimized! Cache files created.');
    }

    public function toggleMaintenance(Request $request)
    {
        if ($request->mode === 'on') {
            Artisan::call('down', ['--message' => 'Site under maintenance', '--retry' => 60]);
        } else {
            Artisan::call('up');
        }

        return response()->json(['success' => true, 'maintenance' => $request->mode === 'on']);
    }

    public function resetProducts()
    {
        // Reset products keeping structure
        DB::statement('DELETE FROM products');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');

        return redirect()->back()->with('success', 'All products have been reset!');
    }

    public function clearOrders()
    {
        DB::statement('DELETE FROM order_items');
        DB::statement('DELETE FROM orders');
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE order_items AUTO_INCREMENT = 1');

        return redirect()->back()->with('success', 'All orders have been cleared!');
    }

    public function getSetting($key)
    {
        $settings = $this->getSettings();
        return $settings[$key] ?? null;
    }
}
