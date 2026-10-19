# 🚀 MyShop Stress Testing Guide

## ⚠️ Pre-Testing Warning

**Before running stress tests:**
1. Make a backup of your database
2. Use a local/development environment
3. Notify others that the site will be under load

---

## 📊 Test Scenarios

### 1️⃣ Basic Load Test - Homepage

```bash
# Using Apache Bench (ab) - Install via XAMPP or separately
# Test 100 requests, 10 concurrent users

ab -n 100 -c 10 http://localhost:8000/

# Or if using PHP built-in server:
ab -n 100 -c 10 http://127.0.0.1:8000/
```

### 2️⃣ Products Page Load Test

```bash
# Test products listing
ab -n 200 -c 20 http://localhost:8000/products

# Test with keep-alive
ab -n 200 -c 20 -k http://localhost:8000/products
```

### 3️⃣ Login Stress Test

```bash
# Test login endpoint
ab -n 100 -c 10 -p login_data.txt -T 'application/x-www-form-urlencoded' http://localhost:8000/customer/login
```

---

## 🔧 PHP Stress Test Script

Create this file: `stress_test.php` in your project root:

```php
<?php
/**
 * MyShop Stress Testing Script
 * Run: php stress_test.php
 */

echo "🚀 MyShop Stress Testing\n";
echo "========================\n\n";

// Configuration
$baseUrl = 'http://127.0.0.1:8000'; // Change if different
$requests = 100;
$concurrent = 10;

echo "📊 Configuration:\n";
echo "   URL: $baseUrl\n";
echo "   Total Requests: $requests\n";
echo "   Concurrent Users: $concurrent\n\n";

// Test URLs
$testUrls = [
    '/' => 'Homepage',
    '/products' => 'Products List',
    '/videos' => 'Videos Page',
    '/aboutus' => 'About Us',
    '/contact' => 'Contact Page',
];

echo "🧪 Starting Tests...\n";
echo str_repeat("=", 50) . "\n\n";

$results = [];

foreach ($testUrls as $url => $name) {
    echo "Testing: $name ($url)\n";
    
    $startTime = microtime(true);
    $successful = 0;
    $failed = 0;
    
    // Simple concurrent simulation
    for ($i = 0; $i < $requests; $i++) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            $successful++;
        } else {
            $failed++;
        }
        
        // Progress indicator
        if (($i + 1) % 20 == 0) {
            echo ".";
        }
    }
    
    $endTime = microtime(true);
    $duration = $endTime - $startTime;
    
    $results[$name] = [
        'successful' => $successful,
        'failed' => $failed,
        'duration' => $duration,
        'requests_per_second' => $requests / $duration,
    ];
    
    echo " ✓ Done!\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "📊 RESULTS\n";
echo str_repeat("=", 50) . "\n\n";

foreach ($results as $name => $data) {
    echo "🔹 $name\n";
    echo "   ✅ Successful: {$data['successful']} / $requests\n";
    echo "   ❌ Failed: {$data['failed']} / $requests\n";
    echo "   ⏱ Duration: " . round($data['duration'], 2) . "s\n";
    echo "   📈 RPS: " . round($data['requests_per_second'], 2) . " req/s\n\n";
}

echo "⚠️ Note: For accurate stress testing, use Apache Bench (ab) or Laravel Dusk\n";
echo "   This is a basic test. Production testing should use specialized tools.\n";
```

---

## 🎯 Laravel Stress Testing with Artisan

### Create a Stress Test Command

```bash
php artisan make:command StressTest
```

Then edit `app/Console/Commands/StressTest.php`:

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class StressTest extends Command
{
    protected $signature = 'test:stress {--requests=100 : Number of requests} {--concurrent=10 : Concurrent users}';
    protected $description = 'Run stress tests on the application';

    public function handle()
    {
        $requests = (int) $this->option('requests');
        $concurrent = (int) $this->option('concurrent');
        
        $this->info("🚀 Starting Stress Test");
        $this->info("   Requests: $requests");
        $this->info("   Concurrent: $concurrent");
        
        $urls = [
            '/' => 'Homepage',
            '/products' => 'Products',
            '/videos' => 'Videos',
        ];
        
        foreach ($urls as $url => $name) {
            $this->info("Testing: $name");
            
            $start = microtime(true);
            $success = 0;
            $fail = 0;
            
            for ($i = 0; $i < $requests; $i++) {
                try {
                    $response = Http::timeout(5)->get(url($url));
                    if ($response->successful()) {
                        $success++;
                    } else {
                        $fail++;
                    }
                } catch (\Exception $e) {
                    $fail++;
                }
            }
            
            $duration = microtime(true) - $start;
            
            $this->table(
                ['Metric', 'Value'],
                [
                    ['Successful', "$success / $requests"],
                    ['Failed', "$fail / $requests"],
                    ['Duration', round($duration, 2) . 's'],
                    ['RPS', round($requests / $duration, 2)],
                ]
            );
        }
        
        $this->info("✅ Stress test completed!");
    }
}
```

**Run with:**
```bash
php artisan test:stress --requests=200 --concurrent=20
```

---

## 🧪 Database Stress Test

### Test with Many Concurrent Logins

```php
// Create test_customers.php
<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

echo "Creating test customers...\n";

for ($i = 1; $i <= 50; $i++) {
    Customer::create([
        'name' => "TestUser$i",
        'email' => "test$i@example.com",
        'password' => Hash::make('password'),
        'phone' => "010000000$i",
    ]);
    
    if ($i % 10 == 0) {
        echo "Created $i users...\n";
    }
}

echo "✅ Created 50 test customers!\n";
```

---

## 📊 JMeter Test Plan (Advanced)

### For Windows - Download JMeter

1. Download from: https://jmeter.apache.org/download_jmeter.cgi
2. Run: `jmeter.bat`
3. Create test plan with:
   - Thread Group (100 users, 10 ramp-up, loop 5)
   - HTTP Request Defaults
   - View Results Tree
   - Summary Report

---

## 🚨 Quick Browser Stress Test

Open browser console and run:

```javascript
// Flood test - opens 50 tabs (BE CAREFUL!)
for(let i = 0; i < 50; i++) {
    window.open('http://localhost:8000/', '_blank');
}
```

⚠️ **WARNING**: This will open 50 tabs!

---

## 📈 Expected Results

| Test Type | Good | Warning | Critical |
|-----------|------|---------|----------|
| Response Time | < 200ms | 200-500ms | > 500ms |
| Success Rate | > 99% | 95-99% | < 95% |
| CPU Usage | < 70% | 70-90% | > 90% |
| Memory | < 80% | 80-95% | > 95% |

---

## 🎯 Recommended Stress Test Sequence

```bash
# 1. Light load (baseline)
ab -n 50 -c 5 http://localhost:8000/

# 2. Normal load
ab -n 100 -c 10 http://localhost:8000/

# 3. High load
ab -n 200 -c 20 http://localhost:8000/

# 4. Stress test
ab -n 500 -c 50 http://localhost:8000/

# 5. Spike test (sudden load)
ab -n 1000 -c 100 http://localhost:8000/
```

---

## 🔧 Monitor During Tests

```bash
# In another terminal, monitor:
top          # CPU/Memory usage
htop         # Detailed system monitor
mysqladmin   # Database connections
```

---

## ✅ Post-Test Checklist

- [ ] Check all routes work
- [ ] Verify database integrity
- [ ] Check error logs: `storage/logs/laravel.log`
- [ ] Test login still works
- [ ] Test cart functionality
- [ ] Verify no broken pages

---

**Generated**: {{ date('Y-m-d H:i:s') }}
