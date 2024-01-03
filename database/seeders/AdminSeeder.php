<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder{

    public function run(): void{
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => 'Tawfik Omar',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}