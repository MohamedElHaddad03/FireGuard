<?php

namespace Database\Factories;


use App\Models\statistics;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StatisticsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_debut' => $this->faker->date,
            'date_fin' => $this->faker->date,
            'id_location' => \App\Models\Location::factory()->create()->id_location,
            'injuries' => $this->faker->numberBetween(0, 100),
            'deaths' => $this->faker->numberBetween(0, 50),
            'state' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
