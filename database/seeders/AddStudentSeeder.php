<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddStudentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => '000003',
            'name' => 'Peter',
            'email' => 'student@gmail.com',
            'date_of_birth' => '1999-01-01',
            'address' => '456 Student St',
            'join_date' => '2024-09-04',
            'phone_number' => '56774322',
            'role_name' => 'Student',
            'avatar' => 'photo_defaults.jpg',
            'password' => Hash::make('hellothere'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
