<?php

namespace Database\Factories;

use App\Models\comments;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph,
            'id_user' => \App\Models\User::factory(),
            'id_chat' => \App\Models\Chat::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
