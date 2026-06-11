<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateFromSqlite extends Command
{
    protected $signature = 'bpad:migrate-from-sqlite
        {sqlite-path : Path to the SQLite database backup file}';

    protected $description = 'Import data from a SQLite backup into the current MySQL database';

    public function handle(): int
    {
        $sqlitePath = $this->argument('sqlite-path');

        if (! file_exists($sqlitePath)) {
            $this->error("SQLite file not found: {$sqlitePath}");
            return self::FAILURE;
        }

        $this->info("Reading from SQLite: {$sqlitePath}");

        // Open SQLite connection
        $sqlite = new \PDO("sqlite:{$sqlitePath}");
        $sqlite->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Tables to migrate (order matters for foreign keys)
        $tables = [
            'users',
            'website_settings',
            'posts',
            'media',
            'ppid_documents',
            'galleries',
            'audit_logs',
        ];

        foreach ($tables as $table) {
            $this->importTable($sqlite, $table);
        }

        $this->info('');
        $this->info('Data migration complete!');
        $this->info('Run: php artisan db:seed --force  (to ensure settings & galleries are up to date)');

        return self::SUCCESS;
    }

    private function importTable(\PDO $sqlite, string $table): void
    {
        $this->info("Importing table: {$table}...");

        try {
            $stmt = $sqlite->query("SELECT * FROM {$table}");
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $this->warn("  Table '{$table}' does not exist in SQLite, skipping.");
            return;
        }

        if (empty($rows)) {
            $this->warn("  Table '{$table}' is empty, skipping.");
            return;
        }

        $count = 0;
        foreach ($rows as $row) {
            // Decode JSON fields if present
            foreach ($row as $key => $value) {
                if (is_string($value) && in_array($key, ['old_values', 'new_values'])) {
                    $decoded = json_decode($value, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $row[$key] = $decoded;
                    }
                }
            }

            // Convert boolean-like values
            foreach ($row as $key => $value) {
                if (in_array($key, ['is_active', 'is_public', 'is_published']) && $value !== null) {
                    $row[$key] = (bool) $value;
                }
            }

            try {
                DB::table($table)->insert($row);
                $count++;
            } catch (\Exception $e) {
                $this->warn("  Skipped row in '{$table}': " . $e->getMessage());
            }
        }

        $this->info("  Imported {$count} rows into '{$table}'.");
    }
}
