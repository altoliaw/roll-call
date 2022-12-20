<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
            $data = json_decode(file_get_contents(database_path('seeders/RawSqlData/backup_' . $table . '.sql')), true);
            DB::table($table)->truncate();
            DB::table($table)->insert($data);
        }
    }
}
