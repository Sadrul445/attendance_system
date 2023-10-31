<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
        [
            'name' => 'admin',
            'email' => 'admin@lap.com',
            'password' => Hash::make('lap#2023'),
            'role' => 'admin'
        ],
        // [
        //     'name' => 'employee',
        //     'email' => 'employee@lap.com',
        //     'password' => Hash::make('lap#2023'),
        //     'role' => 'employee'
        // ]
    );
    }
}
