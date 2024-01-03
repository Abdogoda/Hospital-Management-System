<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder{

    public function run(): void{
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Leo Messi',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}