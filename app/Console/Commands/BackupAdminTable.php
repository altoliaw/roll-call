<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupAdminTable extends Command
{
       /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup admin tables';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tables = [
            'admin_extension_histories',
            'admin_extensions',
            'admin_menu',
            'admin_permission_menu',
            'admin_permissions',
            'admin_role_menu',
            'admin_role_permissions',
            'admin_role_users',
            'admin_roles',
            'admin_settings',
            'admin_users',
        ];

        foreach ($tables as $table) {
            file_put_contents(database_path('seeders/RawSqlData/backup_' . $table . '.sql'), json_encode(DB::table($table)->get()->toArray()));
        }
        return Command::SUCCESS;
    }
}
