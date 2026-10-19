<?php
/**
 * MyShop Stress Testing Script
 * 
 * HOW TO USE:
 * 1. Make sure your Laravel server is running: php artisan serve
 * 2. Run this script: php stress_test.php
 * 
 * ⚠️ For accurate results, run on local machine
 */

echo "\n";
echo "╔═══════════════════════════════════════════════════════════╗\n";
echo "║       🚀 MyShop Stress Testing Script v1.0           ║\n";
echo "╚═══════════════════════════════════════════════════════════╝\n";
echo "\n";

// Configuration - CHANGE THIS TO YOUR URL
$baseUrl = 'http://127.0.0.1:8000';
$requests = 100;
$concurrent = 10;

echo "📊 Configuration:\n";
echo "   ├─ URL: $baseUrl\n";
echo "   ├─ Total Requests: $requests\n";
echo "   ├─ Concurrent Users: $concurrent\n";
echo "   └─ Press Ctrl+C to stop\n\n";

// Test URLs with names
$testUrls = [
    '/' => '🏠 Homepage',
    '/products' => '📦 Products List',
    '/videos' => '🎬 Videos Page',
    '/aboutus' => '📝 About Us',
    '/contact' => '📧 Contact Page',
];

echo "🧪 Starting Stress Tests...\n";
echo str_repeat("─", 55) . "\n";

$results = [];

foreach ($testUrls as $url => $name) {
    echo "\n⏳ Testing: $name\n";
    echo str_repeat("─", 40) . "\n";
    
    $startTime = microtime(true);
    $successful = 0;
    $failed = 0;
    $totalTime = 0;
    
    // Simulate concurrent requests
    for ($i = 0; $i < $requests; $i++) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'MyShop Stress Test/1.0');
        
        $requestStart = microtime(true);
        $response = curl_exec($ch);
        $requestEnd = microtime(true);
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $totalTime += ($requestEnd - $requestStart);
        
        if ($httpCode == 200 || $httpCode == 302) {
            $successful++;
        } else {
            $failed++;
            echo "   ⚠️ Request #$i failed with code: $httpCode\n";
        }
        
        curl_close($ch);
        
        // Progress indicator
        if (($i + 1) % 20 == 0) {
            echo "   ";
            for ($j = 0; $j < 3; $j++) { echo "█"; usleep(50000); }
            echo " " . ($i + 1) . "/$requests\n";
        }
    }
    
    $endTime = microtime(true);
    $duration = $endTime - $startTime;
    
    $results[$name] = [
        'url' => $url,
        'successful' => $successful,
        'failed' => $failed,
        'duration' => $duration,
        'avg_request_time' => $totalTime / $requests,
        'requests_per_second' => $requests / $duration,
        'success_rate' => ($successful / $requests) * 100,
    ];
    
    echo "\n   ✅ Successful: {$successful}/{$requests} (" . round($results[$name]['success_rate'], 1) . "%)\n";
    echo "   ❌ Failed: {$failed}/{$requests}\n";
    echo "   ⏱ Total Duration: " . round($duration, 2) . "s\n";
    echo "   📈 Avg Request Time: " . round($results[$name]['avg_request_time'] * 1000, 2) . "ms\n";
    echo "   🚀 RPS: " . round($results[$name]['requests_per_second'], 2) . " req/s\n";
}

// Summary
echo "\n";
echo str_repeat("═", 55) . "\n";
echo "📊 FINAL RESULTS SUMMARY\n";
echo str_repeat("═", 55) . "\n\n";

echo "┌──────────────────┬────────┬────────┬────────┬─────────┐\n";
echo "│ Page             │ Status │ Failed │  RPS   │ Avg ms  │\n";
echo "├──────────────────┼────────┼────────┼────────┼─────────┤\n";

foreach ($results as $name => $data) {
    $status = $data['success_rate'] >= 95 ? '✅' : ($data['success_rate'] >= 80 ? '⚠️' : '❌');
    printf("│ %-16s │ %s %-4s │ %-6s │ %-6s │ %-7s │\n",
        substr($name, 0, 16),
        $status,
        round($data['success_rate'], 0) . "%",
        $data['failed'],
        round($data['requests_per_second'], 1),
        round($data['avg_request_time'] * 1000, 1)
    );
}

echo "└──────────────────┴────────┴────────┴────────┴─────────┘\n";

echo "\n📈 Performance Analysis:\n";

$avgRps = array_sum(array_column($results, 'requests_per_second')) / count($results);
$avgSuccess = array_sum(array_column($results, 'success_rate')) / count($results);
$avgTime = array_sum(array_column($results, 'avg_request_time')) / count($results);

if ($avgSuccess >= 95 && $avgTime < 0.5) {
    echo "   🌟 EXCELLENT - Site handles load very well!\n";
} elseif ($avgSuccess >= 90 && $avgTime < 1) {
    echo "   ✅ GOOD - Site performs acceptably under load\n";
} elseif ($avgSuccess >= 80) {
    echo "   ⚠️ WARNING - Some requests failing, consider optimization\n";
} else {
    echo "   ❌ CRITICAL - Site is struggling with load!\n";
}

echo "\n   ├─ Average Success Rate: " . round($avgSuccess, 1) . "%\n";
echo "   ├─ Average RPS: " . round($avgRps, 2) . " req/s\n";
echo "   └─ Average Response Time: " . round($avgTime * 1000, 2) . "ms\n";

echo "\n" . str_repeat("─", 55) . "\n";
echo "⚠️  Note: For accurate production testing, use Apache Bench (ab)\n";
echo "    or specialized load testing tools like JMeter/Locust\n";
echo "\n✅ Stress Test Complete!\n\n";
