<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorTableSeeder extends Seeder{

    public function run(): void{
        DB::table('doctors')->delete();
        DB::table('doctors')->insert([
            'email' => 'doctor1@gmail.com',
            // 'appointments' => fake()->randomElement([1,2,3,4,5,6,7]),
            'email_verified_at' => now(),
            'created_At' => now(),
            'updated_at' => now(),
            'phone' => '01142366716',
            'section_id' => Section::all()->random()->id,
            'password' => Hash::make('123456'),
        ]);
        DB::table('doctors')->insert([
            'email' => 'doctor2@gmail.com',
            // 'appointments' => fake()->randomElement([1,2,3,4,5,6,7]),
            'email_verified_at' => now(),
            'created_At' => now(),
            'updated_at' => now(),
            'phone' => '01019135059',
            'section_id' => Section::all()->random()->id,
            'password' => Hash::make('123456'),
        ]);
        DB::table('doctor_translations')->insert([
            'name' => 'Karem Elsadany',
            'locale' => 'en',
            'doctor_id' => 1,
        ]);
        DB::table('doctor_translations')->insert([
            'name' => 'Sofian Emrabet',
            'locale' => 'en',
            'doctor_id' => 2,
        ]);
        DB::table('doctor_translations')->insert([
            'name' => 'كريم السعدني',
            'locale' => 'ar',
            'doctor_id' => 1,
        ]);
        DB::table('doctor_translations')->insert([
            'name' => 'سفيان امرابط',
            'locale' => 'ar',
            'doctor_id' => 2,
        ]);
        Doctor::factory()->count(30)->create();
    }
}