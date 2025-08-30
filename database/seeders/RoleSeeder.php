<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator system'],
            ['name' => 'redaktur', 'description' => 'Redaktur berita'],
            ['name' => 'reporter', 'description' => 'Reporter berita'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }

        echo "Roles seeded successfully!\n";
    }
}
