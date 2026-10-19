<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Security Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains security settings for the admin panel.
    | Customize these settings to enhance your admin security.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist
    |--------------------------------------------------------------------------
    |
    | Restrict admin access to specific IP addresses.
    | Add specific IPs or use patterns like 192.168.*.*
    |
    */
    'security' => [
        // Enable IP whitelist (recommended for production)
        'ip_whitelist_enabled' => env('ADMIN_IP_WHITELIST_ENABLED', false),

        // Allowed IP addresses
        'ip_whitelist' => explode(',', env('ADMIN_IP_WHITELIST', '')),

        /*
        |--------------------------------------------------------------------------
        | Session Security
        |--------------------------------------------------------------------------
        */
        // Enable session fingerprinting
        'session_fingerprint_enabled' => env('ADMIN_SESSION_FINGERPRINT', true),

        // Prevent concurrent sessions (same account from multiple devices)
        'prevent_concurrent_sessions' => env('ADMIN_PREVENT_CONCURRENT', false),

        // Session timeout (minutes) - auto logout after inactivity
        'session_timeout_enabled' => env('ADMIN_SESSION_TIMEOUT_ENABLED', true),
        'session_timeout_minutes' => env('ADMIN_SESSION_TIMEOUT_MINUTES', 30),

        /*
        |--------------------------------------------------------------------------
        | Login Security
        |--------------------------------------------------------------------------
        */
        // Maximum login attempts before temporary block
        'login_max_attempts' => env('ADMIN_LOGIN_MAX_ATTEMPTS', 5),

        // Lockout duration after max attempts (minutes)
        'login_decay_minutes' => env('ADMIN_LOGIN_DECAY_MINUTES', 15),

        // Maximum password reset attempts
        'password_reset_max_attempts' => env('ADMIN_PASSWORD_RESET_MAX_ATTEMPTS', 3),
        'password_reset_decay_minutes' => env('ADMIN_PASSWORD_RESET_DECAY_MINUTES', 30),

        // Require password change on first login
        'require_password_change_first_login' => env('ADMIN_REQUIRE_PASSWORD_CHANGE', false),

        // Require password change periodically (days)
        'password_change_interval_days' => env('ADMIN_PASSWORD_CHANGE_INTERVAL', 90),

        /*
        |--------------------------------------------------------------------------
        | API Security
        |--------------------------------------------------------------------------
        */
        // API rate limiting
        'api_max_attempts' => env('ADMIN_API_MAX_ATTEMPTS', 60),
        'api_decay_minutes' => env('ADMIN_API_DECAY_MINUTES', 1),

        /*
        |--------------------------------------------------------------------------
        | Two-Factor Authentication
        |--------------------------------------------------------------------------
        */
        // Enable 2FA (requires setup)
        'two_factor_enabled' => env('ADMIN_TWO_FACTOR_ENABLED', false),

        // 2FA issuer name
        'two_factor_issuer' => env('ADMIN_TWO_FACTOR_ISSUER', 'MyShop'),

        /*
        |--------------------------------------------------------------------------
        | Login Logging
        |--------------------------------------------------------------------------
        */
        // Enable detailed login logging
        'log_login_attempts' => env('ADMIN_LOG_LOGIN_ATTEMPTS', true),

        // Log failed login attempts
        'log_failed_attempts' => env('ADMIN_LOG_FAILED_ATTEMPTS', true),

        // Alert on suspicious activity
        'alert_on_suspicious_activity' => env('ADMIN_ALERT_SUSPICIOUS', true),

        // Suspicious activity threshold (failed attempts)
        'suspicious_activity_threshold' => env('ADMIN_SUSPICIOUS_THRESHOLD', 5),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Route Configuration
    |--------------------------------------------------------------------------
    */
    'routes' => [
        // Admin URL prefix
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),

        // Admin login URL
        'login_url' => env('ADMIN_LOGIN_URL', 'admin/login'),

        // Admin logout URL
        'logout_url' => env('ADMIN_LOGOUT_URL', 'admin/logout'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard Settings
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        // Items per page for admin tables
        'per_page' => env('ADMIN_PER_PAGE', 20),

        // Enable dashboard analytics
        'enable_analytics' => env('ADMIN_ANALYTICS_ENABLED', true),

        // Dashboard refresh interval (seconds)
        'refresh_interval' => env('ADMIN_REFRESH_INTERVAL', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed File Uploads
    |--------------------------------------------------------------------------
    */
    'uploads' => [
        // Maximum file size (KB)
        'max_size' => env('ADMIN_UPLOAD_MAX_SIZE', 5120), // 5MB

        // Allowed file extensions
        'allowed_extensions' => explode(',', env('ADMIN_ALLOWED_EXTENSIONS', 'jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx')),

        // Enable virus scanning (requires ClamAV)
        'scan_enabled' => env('ADMIN_SCAN_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Notifications
    |--------------------------------------------------------------------------
    */
    'notifications' => [
        // Send email on suspicious activity
        'email_on_suspicious' => env('ADMIN_NOTIFY_SUSPICIOUS_EMAIL', false),

        // Send push notification on suspicious activity
        'push_on_suspicious' => env('ADMIN_NOTIFY_SUSPICIOUS_PUSH', false),

        // Notify these emails on security events
        'notify_emails' => explode(',', env('ADMIN_NOTIFY_EMAILS', '')),
    ],

];
