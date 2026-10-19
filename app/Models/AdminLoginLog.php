<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLoginLog extends Model
{
    use HasFactory;

    protected $table = 'admin_login_logs';

    protected $fillable = [
        'employee_id',
        'email',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'status', // success, failed, blocked
        'failure_reason',
        'country',
        'city',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];

    /**
     * Get the employee associated with this login
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Scope for successful logins
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Scope for failed logins
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for blocked logins
     */
    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }

    /**
     * Scope for recent logins (last 24 hours)
     */
    public function scopeRecent($query)
    {
        return $query->where('login_at', '>=', now()->subDay());
    }

    /**
     * Scope for suspicious activity
     */
    public function scopeSuspicious($query)
    {
        return $query->where('status', '!=', 'success')
                     ->where('login_at', '>=', now()->subHour());
    }

    /**
     * Check if IP is suspicious
     */
    public static function isIpSuspicious(string $ip): bool
    {
        $recentFailures = self::where('ip_address', $ip)
            ->where('login_at', '>=', now()->subHour())
            ->failed()
            ->count();

        return $recentFailures >= 5;
    }

    /**
     * Get failed login count for IP
     */
    public static function getFailedCountForIp(string $ip): int
    {
        return self::where('ip_address', $ip)
            ->where('login_at', '>=', now()->subHour())
            ->failed()
            ->count();
    }

    /**
     * Get last login for employee
     */
    public static function getLastLogin(int $employeeId): ?self
    {
        return self::where('employee_id', $employeeId)
            ->successful()
            ->latest('login_at')
            ->first();
    }
}
