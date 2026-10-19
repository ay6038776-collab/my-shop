<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class StressTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:stresstest 
                            {--requests=100 : Number of total requests}
                            {--concurrent=10 : Number of concurrent users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run stress tests on the MyShop application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $requests = (int) $this->option('requests');
        $concurrent = (int) $this->option('concurrent');
        
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║       🚀 MyShop Stress Testing Script v1.0               ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->info("");
        
        $this->info("📊 Configuration:");
        $this->line("   ├─ Total Requests: {$requests}");
        $this->line("   └─ Concurrent Users: {$concurrent}");
        $this->line("");
        
        // URLs to test
        $urls = [
            '/' => 'Homepage',
            '/products' => 'Products List',
            '/videos' => 'Videos',
            '/aboutus' => 'About Us',
            '/contact' => 'Contact',
        ];
        
        $results = [];
        
        foreach ($urls as $url => $name) {
            $this->info("⏳ Testing: {$name} ({$url})");
            
            $start = microtime(true);
            $success = 0;
            $fail = 0;
            $totalTime = 0;
            
            $progressBar = $this->output->createProgressBar($requests);
            $progressBar->start();
            
            for ($i = 0; $i < $requests; $i++) {
                $requestStart = microtime(true);
                
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
                
                $requestEnd = microtime(true);
                $totalTime += ($requestEnd - $requestStart);
                
                $progressBar->advance();
            }
            
            $progressBar->finish();
            $this->newLine();
            
            $duration = microtime(true) - $start;
            
            $results[] = [
                'name' => $name,
                'url' => $url,
                'successful' => $success,
                'failed' => $fail,
                'duration' => $duration,
                'rps' => $requests / $duration,
                'avg_time' => ($totalTime / $requests) * 1000,
                'success_rate' => ($success / $requests) * 100,
            ];
            
            $status = $success >= 95 ? '✅' : ($success >= 80 ? '⚠️' : '❌');
            $this->line("   ✅ Success: {$success} | ❌ Failed: {$fail} | ⏱: " . round($duration, 2) . "s");
            $this->line("");
        }
        
        // Summary Table
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║                    📊 RESULTS SUMMARY                        ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->line("");
        
        $this->table(
            ['Page', 'Success', 'Failed', 'RPS', 'Avg Time (ms)'],
            collect($results)->map(function ($r) {
                return [
                    $r['name'],
                    $r['successful'] . ' (' . round($r['success_rate'], 1) . '%)',
                    $r['failed'],
                    round($r['rps'], 2),
                    round($r['avg_time'], 2),
                ];
            })->toArray()
        );
        
        // Database stats
        $this->info("📊 Current Database Stats:");
        try {
            $stats = [
                ['Customers', DB::table('customers')->count()],
                ['Employees', DB::table('employees')->count()],
                ['Products', DB::table('products')->count()],
                ['Orders', DB::table('orders')->count()],
            ];
            $this->table(['Table', 'Count'], $stats);
        } catch (\Exception $e) {
            $this->warn("   ⚠️ Could not fetch DB stats: " . $e->getMessage());
        }
        
        $this->info("");
        $this->info("✅ Stress test completed!");
    }
}
