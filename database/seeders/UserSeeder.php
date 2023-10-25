<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@app.com',
            'password' => bcrypt('admin')
        ]); 
        
        $admin->assignRole('administrator');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@app.com',
            'password' => bcrypt('user')
        ]); 
        
        $user->assignRole('user');
    }
}
