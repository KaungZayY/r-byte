<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teammate>
 */
class TeammateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => $this->faker->numberBetween(0,100),
            'user_id' => $this->faker->numberBetween(0,100),
            'invited_by' => $this->faker->numberBetween(0, 100)
        ];
    }
}
