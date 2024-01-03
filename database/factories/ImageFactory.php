<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;


class ImageFactory extends Factory{

    public function definition(): array{
        return [
            'filename' => fake()->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg']),
            'imageable_id' => Doctor::all()->random()->id,
            'imageable_type' => 'App\Models\Doctor',
        ];
    }
}