<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    $admin = User::updateOrCreate(
        ['email' => 'admin@test.com'],
        [
            'nickname' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345')
        ]
    );
    
    $admin->assignRole($adminRole);
        
    }
}
