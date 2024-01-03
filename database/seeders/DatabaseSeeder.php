<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

    public function run(): void{

        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            // AppoinmentSeeder::class,
            SectionSeeder::class,
            DoctorTableSeeder::class,
            PatientSeeder::class,
            ServiceSeeder::class,
            ImageSeeder::class,
            RayEmployeeSeeder::class,
            LaboratoryEmployeeSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}