<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory{

    public function definition(): array{
        return [
            'name' => fake()->unique()->randomElement(['Department of Surgery', 'Operations department', 'x_ray place', 'Laboratory department', 'Department of Neurology', 'Department of Cardiology','children section']),
            'description' => fake()->paragraph(),
        ];
    }
}