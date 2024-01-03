<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeSeeder extends Seeder{

    public function run(): void{
        DB::table('laboratory_employees')->delete();
        DB::table('laboratory_employees')->insert([
            'name' => 'Hassan Mohammed',
            'email' => 'laboratory_employee1@gmail.com',
            'created_At' => now(),
            'password' => Hash::make('123456'),
        ]);
    }
}