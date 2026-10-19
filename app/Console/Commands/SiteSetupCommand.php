<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SiteSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:setup {--force : Force setup without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup MyShop site for first use';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║          🚀 MyShop Setup Command v1.0                  ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->line("");

        // Check if already set up
        try {
            $tables = DB::connection()->getPdo()->query("SHOW TABLES")->fetchAll();
            $tableCount = count($tables);
            
            if ($tableCount > 0 && !$this->option('force')) {
                $this->warn("⚠️  Database already has {$tableCount} tables!");
                if (!$this->confirm('Do you want to continue anyway?')) {
                    $this->info("Setup cancelled.");
                    return;
                }
            }
        } catch (\Exception $e) {
            $this->error("❌ Database connection failed: " . $e->getMessage());
            return;
        }

        $this->info("📋 Setup Steps:");
        $this->line("");
        
        // Step 1: Run Migrations
        $this->info("1️⃣  Running Migrations...");
        if ($this->confirm('Run database migrations?', true)) {
            Artisan::call('migrate', ['--force' => true]);
            $this->line(Artisan::output());
            $this->info("   ✅ Migrations completed");
        }

        // Step 2: Create Storage Link
        $this->info("2️⃣  Creating Storage Link...");
        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
            $this->line(Artisan::output());
            $this->info("   ✅ Storage link created");
        } else {
            $this->info("   ℹ️  Storage link already exists");
        }

        // Step 3: Clear Cache
        $this->info("3️⃣  Clearing Cache...");
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        $this->info("   ✅ Cache cleared");

        // Step 4: Optimize
        $this->info("4️⃣  Optimizing Application...");
        Artisan::call('optimize');
        $this->info("   ✅ Application optimized");

        // Step 5: Create Admin User
        $this->info("5️⃣  Admin User Setup...");
        if ($this->confirm('Create admin user?', true)) {
            $name = $this->ask('Admin name', 'Admin');
            $email = $this->ask('Admin email', 'admin@myshop.com');
            $password = $this->secret('Admin password');
            
            try {
                DB::table('employees')->insert([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->info("   ✅ Admin user created!");
            } catch (\Exception $e) {
                $this->error("   ❌ Failed to create admin: " . $e->getMessage());
            }
        }

        // Summary
        $this->line("");
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║                    ✅ SETUP COMPLETE                       ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->line("");
        
        $this->table(
            ['Item', 'Status'],
            [
                ['Migrations', '✅ Done'],
                ['Storage Link', '✅ Done'],
                ['Cache Clear', '✅ Done'],
                ['Optimization', '✅ Done'],
            ]
        );

        $this->line("");
        $this->info("🌐 Next Steps:");
        $this->line("   1. Run: php artisan serve");
        $this->line("   2. Visit: http://127.0.0.1:8000/admin/login");
        $this->line("   3. Login with your admin credentials");
        $this->line("");
    }
}
