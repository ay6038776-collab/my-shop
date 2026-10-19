<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:backup 
                            {--type=database : Backup type (database|files|full)}
                            {--keep=5 : Number of backups to keep}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup MyShop database and files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("╔═══════════════════════════════════════════════════════════╗");
        $this->info("║          💾 MyShop Backup Command v1.0                  ║");
        $this->info("╚═══════════════════════════════════════════════════════════╝");
        $this->line("");

        $type = $this->option('type');
        $keep = (int) $this->option('keep');

        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $timestamp = date('Y-m-d_His');
        $backupName = "backup_{$timestamp}";

        switch ($type) {
            case 'database':
                $this->backupDatabase($backupDir, $backupName);
                break;
            case 'files':
                $this->backupFiles($backupDir, $backupName);
                break;
            case 'full':
                $this->backupDatabase($backupDir, $backupName);
                $this->backupFiles($backupDir, $backupName);
                $this->createFullBackup($backupDir, $backupName);
                break;
            default:
                $this->error("Invalid backup type. Use: database, files, or full");
                return;
        }

        // Clean old backups
        $this->cleanOldBackups($backupDir, $keep);

        $this->info("");
        $this->info("✅ Backup completed successfully!");
    }

    /**
     * Backup database
     */
    protected function backupDatabase($backupDir, $backupName)
    {
        $this->info("📦 Backing up Database...");

        try {
            $tables = DB::connection()->getPdo()->query("SHOW TABLES")->fetchAll();
            $data = [];

            foreach ($tables as $table) {
                $tableName = $table[0];
                $rows = DB::table($tableName)->get();
                $data[$tableName] = $rows;
            }

            $filename = "{$backupDir}/{$backupName}_database.json";
            file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

            $size = $this->formatBytes(filesize($filename));
            $this->info("   ✅ Database backed up: " . basename($filename) . " ({$size})");
        } catch (\Exception $e) {
            $this->error("   ❌ Database backup failed: " . $e->getMessage());
        }
    }

    /**
     * Backup important files
     */
    protected function backupFiles($backupDir, $backupName)
    {
        $this->info("📁 Backing up Files...");

        $filesToBackup = [
            base_path('.env') => '.env',
            base_path('composer.json') => 'composer.json',
            base_path('composer.lock') => 'composer.lock',
        ];

        $uploadDir = storage_path('app/public/uploads');
        if (File::exists($uploadDir)) {
            $filesToBackup[$uploadDir] = 'uploads';
        }

        $zip = new ZipArchive();
        $zipName = "{$backupDir}/{$backupName}_files.zip";

        if ($zip->open($zipName, ZipArchive::CREATE) === true) {
            foreach ($filesToBackup as $path => $name) {
                if (File::exists($path)) {
                    if (is_dir($path)) {
                        $zip->addEmptyDir($name);
                        $this->addDirectoryToZip($zip, $path, $name);
                    } else {
                        $zip->addFile($path, $name);
                    }
                    $this->info("   ✅ Added: {$name}");
                }
            }
            $zip->close();

            $size = $this->formatBytes(filesize($zipName));
            $this->info("   ✅ Files backed up: " . basename($zipName) . " ({$size})");
        } else {
            $this->error("   ❌ Failed to create zip file");
        }
    }

    /**
     * Create full backup combining all
     */
    protected function createFullBackup($backupDir, $backupName)
    {
        $this->info("📦 Creating Full Backup Archive...");

        $files = File::files($backupDir);
        $filesToInclude = [];

        foreach ($files as $file) {
            $filename = $file->getFilename();
            if (strpos($filename, $backupName) === 0) {
                $filesToInclude[] = $file->getPathname();
            }
        }

        $zip = new ZipArchive();
        $zipName = "{$backupDir}/{$backupName}_full.zip";

        if ($zip->open($zipName, ZipArchive::CREATE) === true) {
            foreach ($filesToInclude as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();

            // Remove individual files
            foreach ($filesToInclude as $file) {
                File::delete($file);
            }

            $size = $this->formatBytes(filesize($zipName));
            $this->info("   ✅ Full backup created: " . basename($zipName) . " ({$size})");
        }
    }

    /**
     * Add directory recursively to zip
     */
    protected function addDirectoryToZip($zip, $dir, $baseDir)
    {
        $files = File::files($dir);
        foreach ($files as $file) {
            $zip->addFile($file->getPathname(), $baseDir . '/' . $file->getFilename());
        }

        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $name = basename($directory);
            $zip->addEmptyDir($baseDir . '/' . $name);
            $this->addDirectoryToZip($zip, $directory, $baseDir . '/' . $name);
        }
    }

    /**
     * Clean old backups
     */
    protected function cleanOldBackups($backupDir, $keep)
    {
        $this->info("🧹 Cleaning old backups (keeping {$keep})...");

        $files = File::files($backupDir);
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'path' => $file->getPathname(),
                'time' => $file->getMTime()
            ];
        }

        usort($backups, function ($a, $b) {
            return $b['time'] - $a['time'];
        });

        $removed = 0;
        for ($i = $keep; $i < count($backups); $i++) {
            File::delete($backups[$i]['path']);
            $removed++;
        }

        $this->info("   ✅ Removed {$removed} old backup(s)");
    }

    /**
     * Format bytes to human readable
     */
    protected function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
