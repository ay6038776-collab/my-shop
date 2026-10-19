<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\AdminLoginLog;
use Carbon\Carbon;

class SecurityAuditCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'site:security-audit 
                            {--check=suspicious : Type of check (suspicious, users, sessions, database, all)}
                            {--fix : Attempt to fix issues}
                            {--export : Export report to file}';

    /**
     * The console command description.
     */
    protected $description = 'Security audit for admin panel - check for suspicious activity, weak passwords, and vulnerabilities';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🔒 Starting Security Audit...');
        $this->newLine();

        $check = $this->option('check');
        $fix = $this->option('fix');
        $export = $this->option('export');

        $results = [];

        // Run checks based on selection
        if ($check === 'all' || $check === 'suspicious') {
            $results['suspicious'] = $this->checkSuspiciousActivity();
        }

        if ($check === 'all' || $check === 'users') {
            $results['users'] = $this->checkUserSecurity();
        }

        if ($check === 'all' || $check === 'sessions') {
            $results['sessions'] = $this->checkSessionSecurity();
        }

        if ($check === 'all' || $check === 'database') {
            $results['database'] = $this->checkDatabaseSecurity();
        }

        // Display results
        $this->displayResults($results);

        // Auto-fix if requested
        if ($fix && $check === 'all') {
            $this->autoFix($results);
        }

        // Export if requested
        if ($export) {
            $this->exportReport($results);
        }

        // Summary
        $this->showSummary($results);

        return Command::SUCCESS;
    }

    /**
     * Check for suspicious activity
     */
    protected function checkSuspiciousActivity(): array
    {
        $this->info('📊 Checking Suspicious Activity...');

        $results = [
            'status' => 'ok',
            'issues' => [],
            'warnings' => [],
            'details' => [],
        ];

        // Check for multiple failed logins from same IP
        $failedLogins = AdminLoginLog::where('login_at', '>=', now()->subHour())
            ->failed()
            ->select('ip_address', DB::raw('COUNT(*) as attempts'))
            ->groupBy('ip_address')
            ->having('attempts', '>=', 5)
            ->get();

        if ($failedLogins->count() > 0) {
            $results['status'] = 'warning';
            $results['warnings'][] = [
                'type' => 'multiple_failed_logins',
                'count' => $failedLogins->count(),
                'details' => $failedLogins->toArray(),
            ];

            foreach ($failedLogins as $login) {
                $this->warn("  ⚠️  IP {$login->ip_address} has {$login->attempts} failed login attempts in last hour");
            }
        }

        // Check for blocked IPs
        $blockedCount = Cache::get('blocked_ips_count', 0);
        if ($blockedCount > 0) {
            $results['warnings'][] = [
                'type' => 'blocked_ips',
                'count' => $blockedCount,
            ];
            $this->warn("  ⚠️  {$blockedCount} IPs are currently blocked");
        }

        // Check for suspicious patterns in recent logins
        $suspiciousPatterns = ['OR 1=1', 'UNION SELECT', 'DROP TABLE', '<script>', 'javascript:'];
        $suspiciousLogins = AdminLoginLog::where('login_at', '>=', now()->subDay())
            ->where(function ($query) use ($suspiciousPatterns) {
                foreach ($suspiciousPatterns as $pattern) {
                    $query->orWhere('email', 'LIKE', "%{$pattern}%");
                }
            })
            ->get();

        if ($suspiciousLogins->count() > 0) {
            $results['status'] = 'danger';
            $results['issues'][] = [
                'type' => 'suspicious_patterns',
                'count' => $suspiciousLogins->count(),
                'details' => $suspiciousLogins->toArray(),
            ];

            foreach ($suspiciousLogins as $login) {
                $this->error("  ❌ Suspicious pattern detected from IP {$login->ip_address}");
            }
        }

        return $results;
    }

    /**
     * Check user security
     */
    protected function checkUserSecurity(): array
    {
        $this->info('👥 Checking User Security...');

        $results = [
            'status' => 'ok',
            'issues' => [],
            'warnings' => [],
            'details' => [],
        ];

        // Check for weak passwords
        $weakPasswords = ['123456', 'password', 'admin123', '12345678', 'qwerty', 'letmein'];
        $usersWithWeakPasswords = [];

        $employees = Employee::where('status', 'active')->get();

        foreach ($employees as $employee) {
            // Check for common weak passwords
            foreach ($weakPasswords as $weak) {
                if (Hash::check($weak, $employee->password)) {
                    $usersWithWeakPasswords[] = [
                        'id' => $employee->id,
                        'email' => $employee->email,
                        'name' => $employee->name,
                        'weak_password' => $weak,
                    ];
                }
            }

            // Check for old passwords (not changed in 90 days)
            $passwordAge = $employee->updated_at ? Carbon::parse($employee->updated_at)->diffInDays(now()) : 999;
            if ($passwordAge > 90) {
                $results['warnings'][] = [
                    'type' => 'old_password',
                    'user_id' => $employee->id,
                    'email' => $employee->email,
                    'days_since_change' => $passwordAge,
                ];
                $this->warn("  ⚠️  User {$employee->email} hasn't changed password in {$passwordAge} days");
            }
        }

        if (count($usersWithWeakPasswords) > 0) {
            $results['status'] = 'danger';
            $results['issues'][] = [
                'type' => 'weak_passwords',
                'count' => count($usersWithWeakPasswords),
                'details' => $usersWithWeakPasswords,
            ];

            foreach ($usersWithWeakPasswords as $user) {
                $this->error("  ❌ User {$user['email']} has a weak password!");
            }
        }

        // Check for inactive accounts
        $inactiveThreshold = now()->subDays(30);
        $inactiveUsers = Employee::where('status', 'active')
            ->where(function ($query) use ($inactiveThreshold) {
                $query->where('last_activity', '<', $inactiveThreshold)
                      ->orWhereNull('last_activity');
            })
            ->get();

        if ($inactiveUsers->count() > 0) {
            $results['warnings'][] = [
                'type' => 'inactive_accounts',
                'count' => $inactiveUsers->count(),
            ];
            $this->warn("  ⚠️  {$inactiveUsers->count()} active accounts haven't been used in 30+ days");
        }

        return $results;
    }

    /**
     * Check session security
     */
    protected function checkSessionSecurity(): array
    {
        $this->info('🔑 Checking Session Security...');

        $results = [
            'status' => 'ok',
            'issues' => [],
            'warnings' => [],
            'details' => [],
        ];

        // Check for concurrent sessions
        if (config('admin.security.prevent_concurrent_sessions')) {
            $concurrentSessions = Employee::whereNotNull('last_activity')
                ->where('last_activity', '>=', now()->subMinutes(5))
                ->get();

            if ($concurrentSessions->count() > 0) {
                $results['details'][] = [
                    'type' => 'concurrent_sessions_check_enabled',
                    'active_users' => $concurrentSessions->count(),
                ];
                $this->info("  ✅ Concurrent session protection is enabled");
            }
        }

        // Check session timeout settings
        $timeoutMinutes = config('admin.security.session_timeout_minutes', 30);
        if ($timeoutMinutes < 15) {
            $this->warn("  ⚠️  Session timeout is very short ({$timeoutMinutes} minutes)");
        } elseif ($timeoutMinutes > 60) {
            $this->warn("  ⚠️  Session timeout is quite long ({$timeoutMinutes} minutes) - consider shortening");
        } else {
            $this->info("  ✅ Session timeout is set to {$timeoutMinutes} minutes");
        }

        // Check session fingerprint setting
        if (config('admin.security.session_fingerprint_enabled')) {
            $this->info("  ✅ Session fingerprinting is enabled");
        } else {
            $results['warnings'][] = [
                'type' => 'session_fingerprint_disabled',
            ];
            $this->warn("  ⚠️  Session fingerprinting is disabled - recommend enabling");
        }

        return $results;
    }

    /**
     * Check database security
     */
    protected function checkDatabaseSecurity(): array
    {
        $this->info('🗄️  Checking Database Security...');

        $results = [
            'status' => 'ok',
            'issues' => [],
            'warnings' => [],
            'details' => [],
        ];

        // Check if APP_DEBUG is true in production
        if (config('app.debug') && !app()->environment('local')) {
            $results['issues'][] = [
                'type' => 'debug_mode_enabled',
            ];
            $this->error("  ❌ APP_DEBUG is enabled in non-local environment!");
        }

        // Check database credentials in .env
        $envContent = file_get_contents(base_path('.env'));
        
        if (strpos($envContent, 'DB_HOST=127.0.0.1') !== false && !app()->environment('local')) {
            $results['warnings'][] = [
                'type' => 'localhost_database',
            ];
            $this->warn("  ⚠️  Database is using localhost - ensure proper network security");
        }

        // Check for missing HTTPS enforcement
        if (!config('app.force_https') && !app()->environment('local')) {
            $results['warnings'][] = [
                'type' => 'https_not_forced',
            ];
            $this->warn("  ⚠️  HTTPS is not enforced - consider enabling");
        }

        // Check for proper key
        if (config('app.key') === 'base64:SomeRandomString') {
            $results['issues'][] = [
                'type' => 'default_app_key',
            ];
            $this->error("  ❌ Using default APP_KEY - generate a new one!");
        }

        return $results;
    }

    /**
     * Display audit results
     */
    protected function displayResults(array $results): void
    {
        $this->newLine();
        $this->info('📋 Audit Results:');
        $this->line(str_repeat('-', 60));

        foreach ($results as $category => $result) {
            $status = match($result['status']) {
                'ok' => '✅ OK',
                'warning' => '⚠️  WARNING',
                'danger' => '❌ DANGER',
                default => '❓ UNKNOWN',
            };

            $this->line("{$status} {$category}");
        }
    }

    /**
     * Auto-fix common issues
     */
    protected function autoFix(array $results): void
    {
        $this->newLine();
        $this->info('🔧 Attempting Auto-Fix...');

        // Clear blocked IPs
        if (isset($results['suspicious']['warnings'])) {
            foreach ($results['suspicious']['warnings'] as $warning) {
                if ($warning['type'] === 'blocked_ips') {
                    Cache::forget('blocked_ips_count');
                    $this->info('  ✅ Cleared blocked IP count');
                }
            }
        }

        $this->info('  ✅ Auto-fix completed');
    }

    /**
     * Export report to file
     */
    protected function exportReport(array $results): void
    {
        $filename = 'security_audit_' . now()->format('Y-m-d_His') . '.json';
        $path = storage_path('logs/' . $filename);

        file_put_contents($path, json_encode([
            'generated_at' => now()->toIso8601String(),
            'results' => $results,
        ], JSON_PRETTY_PRINT));

        $this->info("  📄 Report exported to: {$path}");
    }

    /**
     * Show audit summary
     */
    protected function showSummary(array $results): void
    {
        $this->newLine();
        $this->info('📊 Summary:');

        $totalIssues = 0;
        $totalWarnings = 0;

        foreach ($results as $result) {
            $totalIssues += count($result['issues']);
            $totalWarnings += count($result['warnings']);
        }

        if ($totalIssues > 0) {
            $this->error("  ❌ Found {$totalIssues} critical security issues!");
            $this->line("     Run with --fix to attempt automatic fixes");
        }

        if ($totalWarnings > 0) {
            $this->warn("  ⚠️  Found {$totalWarnings} security warnings");
        }

        if ($totalIssues === 0 && $totalWarnings === 0) {
            $this->info('  ✅ No security issues found!');
        }

        $this->newLine();
    }
}
