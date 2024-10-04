<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddTeacher2Seeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => '000005',
            'name' => 'Tr.Ruby',
            'email' => 'teacher2@gmail.com',
            'date_of_birth' => '1980-01-01',
            'address' => '4566 Teacher St',
            'join_date' => '2024-09-05',
            'phone_number' => '12345644',
            'role_name' => 'Teachers',
            'avatar' => 'photo_defaults.jpg',
            'password' => Hash::make('hellothere'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
