<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleRoute;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {  
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // sample routes - ensure these match your route names
        RoleRoute::firstOrCreate(['role_id' => $admin->id, 'route_name' => 'admin.dashboard']);
        RoleRoute::firstOrCreate(['role_id' => $admin->id, 'route_name' => 'reports.index']);
        RoleRoute::firstOrCreate(['role_id' => $userRole->id, 'route_name' => 'user.dashboard']);

        // create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $admin->id,
        ]);

        // create normal user
        User::factory()->create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role_id' => $userRole->id,
        ]);
    }

    
}
