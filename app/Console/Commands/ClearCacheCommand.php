<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:clear
                            {--all : Clear everything}
                            {--config : Clear config cache}
                            {--route : Clear route cache}
                            {--view : Clear view cache}
                            {--cache : Clear application cache}
                            {--temp : Clear temporary files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear MyShop site cache and temporary files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║          🧹 MyShop Cache Clear Command v1.0               ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->line("");

        $options = $this->options();

        // If no specific option, show menu
        if (!$options['all'] && !$options['config'] && !$options['route'] && !$options['view'] && !$options['cache'] && !$options['temp']) {
            $this->showMenu();
            return;
        }

        $cleared = [];

        if ($options['all'] || $options['config']) {
            $this->clearConfig();
            $cleared[] = 'Config';
        }

        if ($options['all'] || $options['route']) {
            $this->clearRoute();
            $cleared[] = 'Route';
        }

        if ($options['all'] || $options['view']) {
            $this->clearView();
            $cleared[] = 'View';
        }

        if ($options['all'] || $options['cache']) {
            $this->clearAppCache();
            $cleared[] = 'Cache';
        }

        if ($options['all'] || $options['temp']) {
            $this->clearTemp();
            $cleared[] = 'Temp Files';
        }

        // Summary
        $this->line("");
        if (count($cleared) > 0) {
            $this->info("╔═══════════════════════════════════════════════════════════╗");
            $this->info("║                    ✅ CLEARED ITEMS                       ║");
            $this->info("╚═══════════════════════════════════════════════════════════╝");
            $this->line("");
            
            foreach ($cleared as $item) {
                $this->line("   ✅ {$item}");
            }
        }

        $this->line("");
    }

    /**
     * Show interactive menu
     */
    protected function showMenu()
    {
        $this->info("What do you want to clear?");
        $this->line("");

        $choices = [
            '1' => 'Config Cache',
            '2' => 'Route Cache',
            '3' => 'View Cache',
            '4' => 'Application Cache',
            '5' => 'Temporary Files',
            '6' => 'All of the above',
        ];

        foreach ($choices as $key => $choice) {
            $this->line("   {$key}. {$choice}");
        }

        $this->line("");
        $choice = $this->ask('Enter your choice (1-6)', '6');

        switch ($choice) {
            case '1':
                $this->clearConfig();
                break;
            case '2':
                $this->clearRoute();
                break;
            case '3':
                $this->clearView();
                break;
            case '4':
                $this->clearAppCache();
                break;
            case '5':
                $this->clearTemp();
                break;
            case '6':
                $this->clearConfig();
                $this->clearRoute();
                $this->clearView();
                $this->clearAppCache();
                $this->clearTemp();
                break;
            default:
                $this->warn("Invalid choice.");
                return;
        }

        $this->line("");
        $this->info("✅ All selected caches cleared!");
    }

    /**
     * Clear config cache
     */
    protected function clearConfig()
    {
        $this->info("🔧 Clearing Config Cache...");
        try {
            Artisan::call('config:clear');
            if (file_exists(config_path('cache/config.php'))) {
                unlink(config_path('cache/config.php'));
            }
            $this->info("   ✅ Config cache cleared");
        } catch (\Exception $e) {
            $this->error("   ❌ Failed: " . $e->getMessage());
        }
    }

    /**
     * Clear route cache
     */
    protected function clearRoute()
    {
        $this->info("🛣️  Clearing Route Cache...");
        try {
            Artisan::call('route:clear');
            $this->info("   ✅ Route cache cleared");
        } catch (\Exception $e) {
            $this->error("   ❌ Failed: " . $e->getMessage());
        }
    }

    /**
     * Clear view cache
     */
    protected function clearView()
    {
        $this->info("👁️  Clearing View Cache...");
        try {
            Artisan::call('view:clear');
            $this->info("   ✅ View cache cleared");
        } catch (\Exception $e) {
            $this->error("   ❌ Failed: " . $e->getMessage());
        }
    }

    /**
     * Clear application cache
     */
    protected function clearAppCache()
    {
        $this->info("💾 Clearing Application Cache...");
        try {
            Artisan::call('cache:clear');
            
            // Also clear schedule cache
            if (file_exists(storage_path('app/framework/cache.data'))) {
                unlink(storage_path('app/framework/cache.data'));
            }
            
            $this->info("   ✅ Application cache cleared");
        } catch (\Exception $e) {
            $this->error("   ❌ Failed: " . $e->getMessage());
        }
    }

    /**
     * Clear temporary files
     */
    protected function clearTemp()
    {
        $this->info("📁 Clearing Temporary Files...");
        try {
            $tempDirs = [
                storage_path('app/temp'),
                storage_path('framework/cache'),
                storage_path('framework/sessions'),
                storage_path('logs'),
            ];

            $count = 0;
            foreach ($tempDirs as $dir) {
                if (File::exists($dir)) {
                    $files = File::files($dir);
                    foreach ($files as $file) {
                        // Only delete old files (older than 1 day)
                        if (time() - $file->getMTime() > 86400) {
                            File::delete($file);
                            $count++;
                        }
                    }
                }
            }

            // Clear composer cache
            if (function_exists('exec')) {
                exec('composer clear-cache 2>/dev/null');
            }

            $this->info("   ✅ Removed {$count} temporary file(s)");
        } catch (\Exception $e) {
            $this->error("   ❌ Failed: " . $e->getMessage());
        }
    }
}
