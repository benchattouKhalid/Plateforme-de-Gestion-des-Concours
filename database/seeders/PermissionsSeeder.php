<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'manage_concours'],
            ['name' => 'manage_candidats'],
            ['name' => 'view_statistiques'],
        ]);

        // Assign permissions to roles
        DB::table('role_permissions')->insert([
            ['role' => 'gestionnaire_global', 'permission_id' => 1], // manage_concours
            ['role' => 'gestionnaire_global', 'permission_id' => 2],
            ['role' => 'gestionnaire_local', 'permission_id' => 2], // manage_candidats
            ['role' => 'gestionnaire_global', 'permission_id' => 3], // view_statistiques
            ['role' => 'admin', 'permission_id' => 1],
            ['role' => 'admin', 'permission_id' => 2],
            ['role' => 'admin', 'permission_id' => 3],
        ]);
    }
}
