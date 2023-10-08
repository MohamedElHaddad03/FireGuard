<?php

namespace Database\Factories;
use App\Models\location;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'longitude' => $this->faker->longitude,
            'attitude' => $this->faker->latitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
