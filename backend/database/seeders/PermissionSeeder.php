<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create_user',
            'update_user',
            'delete_user',
            
            'create_job',
            'update_job',
            'delete_job'
        ];

        foreach ($permissions as $key => $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}
