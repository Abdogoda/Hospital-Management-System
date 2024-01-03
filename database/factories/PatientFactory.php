<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PatientFactory extends Factory{

    public function definition(): array{
        $email = fake()->unique()->safeEmail();
        return [
            'name' => fake()->name,
            'email' => $email,
            'phone' => fake()->unique()->phoneNumber(),
            'blood_type' => fake()->randomElement(['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+']),
            'gender' => fake()->randomElement([1,0]),
            'date_of_birth' => fake()->date(),
            'password' => $email,
            'address' => fake()->address(),
        ];
    }
}