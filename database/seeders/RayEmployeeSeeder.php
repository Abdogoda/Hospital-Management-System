<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeSeeder extends Seeder{

    public function run(): void{
        DB::table('ray_employees')->delete();
        DB::table('ray_employees')->insert([
            'name' => 'Mia Jamse',
            'email' => 'ray_employee1@gmail.com',
            'created_At' => now(),
            'password' => Hash::make('123456'),
        ]);
    }
}