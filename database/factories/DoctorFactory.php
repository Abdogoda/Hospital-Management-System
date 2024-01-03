<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DoctorFactory extends Factory{

    public function definition(): array{
        return [
            'name' => fake()->name,
            'appointments' => fake()->randomElement([1,2,3,4,5,6,7]),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'phone' => fake()->phoneNumber(),
            'section_id' => Section::all()->random()->id,
        ];
    }
}