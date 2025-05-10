<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $backupPath = storage_path('app/backups');
        $filename = $backupPath . '/' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $command = sprintf('mysqldump -u %s -p\'%s\' %s > %s', $username, $password, $database, $filename);

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            $this->info('Database backup was successful.');
        } else {
            $this->error('Database backup failed.');
        }
    }
}
