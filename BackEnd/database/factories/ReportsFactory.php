<?php

namespace Database\Factories;

use App\Models\reports;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReportsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_user' => \App\Models\User::factory(),
            'id_location' => \App\Models\Location::factory(),
            'send_rescue' => $this->faker->boolean,
            'proof' => $this->faker->imageUrl(),
            'confirmation' => $this->faker->randomElement(['unCheck', 'rejected', 'validated']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
