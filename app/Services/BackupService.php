<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Carbon\Carbon;

class BackupService
{
    /**
     * Backup directory path
     */
    protected $backupDir;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
        
        if (!File::exists($this->backupDir)) {
            File::makeDirectory($this->backupDir, 0755, true);
        }
    }

    /**
     * Create full database backup
     */
    public function backupDatabase()
    {
        $timestamp = Carbon::now()->format('Y-m-d_His');
        $filename = "{$this->backupDir}/database_{$timestamp}.json";
        
        $tables = DB::connection()->getPdo()->query("SHOW TABLES")->fetchAll();
        $data = [];

        foreach ($tables as $table) {
            $tableName = $table[0];
            $rows = DB::table($tableName)->get();
            $data[$tableName] = $rows;
        }

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        return [
            'success' => true,
            'filename' => basename($filename),
            'path' => $filename,
            'size' => $this->formatBytes(filesize($filename)),
        ];
    }

    /**
     * Backup files
     */
    public function backupFiles()
    {
        $timestamp = Carbon::now()->format('Y-m-d_His');
        $zipName = "{$this->backupDir}/files_{$timestamp}.zip";

        $zip = new ZipArchive();
        
        if ($zip->open($zipName, ZipArchive::CREATE) === true) {
            // Add .env
            if (File::exists(base_path('.env'))) {
                $zip->addFile(base_path('.env'), '.env');
            }

            // Add uploads
            $uploadDir = storage_path('app/public/uploads');
            if (File::exists($uploadDir)) {
                $zip->addEmptyDir('uploads');
                $this->addDirectoryToZip($zip, $uploadDir, 'uploads');
            }

            $zip->close();

            return [
                'success' => true,
                'filename' => basename($zipName),
                'path' => $zipName,
                'size' => $this->formatBytes(filesize($zipName)),
            ];
        }

        return [
            'success' => false,
            'error' => 'Failed to create zip file',
        ];
    }

    /**
     * Create full system backup
     */
    public function createFullBackup()
    {
        $timestamp = Carbon::now()->format('Y-m-d_His');
        $backupName = "full_backup_{$timestamp}";

        // Backup database
        $dbResult = $this->backupDatabase();
        if (!$dbResult['success']) {
            return $dbResult;
        }

        // Backup files
        $filesResult = $this->backupFiles();
        if (!$filesResult['success']) {
            return $filesResult;
        }

        // Create combined archive
        $combinedZip = "{$this->backupDir}/{$backupName}.zip";
        $zip = new ZipArchive();

        if ($zip->open($combinedZip, ZipArchive::CREATE) === true) {
            $zip->addFile($dbResult['path'], 'database.json');
            $zip->addFile($filesResult['path'], 'files.zip');
            $zip->addFromString('manifest.json', json_encode([
                'created_at' => Carbon::now()->toIso8601String(),
                'version' => '1.0',
                'type' => 'full_backup',
            ]));
            $zip->close();

            // Remove individual files
            File::delete($dbResult['path']);
            File::delete($filesResult['path']);

            return [
                'success' => true,
                'filename' => basename($combinedZip),
                'path' => $combinedZip,
                'size' => $this->formatBytes(filesize($combinedZip)),
            ];
        }

        return [
            'success' => false,
            'error' => 'Failed to create combined backup',
        ];
    }

    /**
     * List all backups
     */
    public function listBackups()
    {
        $files = File::files($this->backupDir);
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
                'size' => $this->formatBytes($file->getSize()),
                'created' => Carbon::createFromTimestamp($file->getMTime())->toDateTimeString(),
                'age' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
            ];
        }

        // Sort by newest first
        usort($backups, function ($a, $b) {
            return strtotime($b['created']) - strtotime($a['created']);
        });

        return $backups;
    }

    /**
     * Restore database from backup
     */
    public function restoreDatabase($filename)
    {
        $filepath = "{$this->backupDir}/{$filename}";

        if (!File::exists($filepath)) {
            return [
                'success' => false,
                'error' => 'Backup file not found',
            ];
        }

        $data = json_decode(file_get_contents($filepath), true);

        if (!$data) {
            return [
                'success' => false,
                'error' => 'Invalid backup file format',
            ];
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($data as $tableName => $rows) {
            DB::table($tableName)->truncate();
            
            foreach ($rows as $row) {
                DB::table($tableName)->insert((array) $row);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        return [
            'success' => true,
            'message' => 'Database restored successfully',
            'tables' => count($data),
        ];
    }

    /**
     * Delete old backups
     */
    public function cleanOldBackups($keep = 5)
    {
        $backups = $this->listBackups();
        $removed = 0;

        for ($i = $keep; $i < count($backups); $i++) {
            if (File::delete($backups[$i]['path'])) {
                $removed++;
            }
        }

        return [
            'success' => true,
            'removed' => $removed,
            'kept' => $keep,
        ];
    }

    /**
     * Add directory to zip recursively
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
