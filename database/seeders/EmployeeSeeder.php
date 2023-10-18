<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees =
            [
                'Zubair Hasan',
                'Md. Kalim Amzad Chy',
                'Syed Mohammad Kadar Uddin Noman',
                'Mohammad Rahad Shaikh',
                'Md. Fahad Kabir',
                'M.S. Sadrul Pasha Chowdhury',
                'Amzad Hossain'
            ];
        foreach ($employees as $name) {
            DB::table('employees')->insert([
                'name' => $name,
            ]);
        }
    }
}
