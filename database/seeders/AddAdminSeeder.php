<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => '000001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'date_of_birth' => '1980-01-01',
            'address' => '456 Admin St',
            'join_date' => '2024-09-03',
            'phone_number' => '555-555-1234',
            'role_name' => 'Admin',
            'avatar' => 'photo_defaults.jpg',
            'password' => Hash::make('admin_password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
