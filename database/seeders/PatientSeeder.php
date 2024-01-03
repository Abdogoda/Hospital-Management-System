<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder{

    public function run(): void{
        DB::table('patients')->delete();
        DB::table('patients')->insert([
            'email' => 'john@gmail.com',
            'phone' => fake()->unique()->phoneNumber(),
            'blood_type' => fake()->randomElement(['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+']),
            'gender' => fake()->randomElement([1,0]),
            'date_of_birth' => '1980-06-05',
            'password' => Hash::make('123456'),
        ]);
        DB::table('patients')->insert([
            'email' => 'thia@gmail.com',
            'phone' => fake()->unique()->phoneNumber(),
            'blood_type' => fake()->randomElement(['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+']),
            'gender' => fake()->randomElement([1,0]),
            'date_of_birth' => '1980-06-05',
            'password' => Hash::make('123456'),
        ]);
        DB::table('patient_translations')->insert([
            'name' => 'John Smith',
            'locale' => 'en',
            'address' => fake()->address(),
            'patient_id' => 1,
        ]);
        DB::table('patient_translations')->insert([
            'name' => 'Thia Queen',
            'locale' => 'en',
            'address' => fake()->address(),
            'patient_id' => 2,
        ]);
        DB::table('patient_translations')->insert([
            'name' => 'جون سميث',
            'locale' => 'ar',
            'address' => 'الولايات المتحدة الامريكية - تكساس',
            'patient_id' => 1,
        ]);
        DB::table('patient_translations')->insert([
            'name' => 'ثيا كوين',
            'locale' => 'ar',
            'address' => 'الولايات المتحدة الامريكية - فلوريدا',
            'patient_id' => 2,
        ]);
        Patient::factory()->count(30)->create();
    }
}