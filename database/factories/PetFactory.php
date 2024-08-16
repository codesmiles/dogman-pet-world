<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "breed" => fake()->word(),
            "age" => fake()->numberBetween(1, 20),
            "gender" => fake()->randomElement(['male', 'female', "harmaphrodite"]),
            "genus" => "canine",
            'weight' => fake()->numberBetween(1, 50),
            "status" => "alive",
            "user_id" => "1", // change
            // "photo" => fake()->image('public/images', 640, 480, null, false),
            "file_number" => fake()->numberBetween(100000, 999999),
            "date_of_birth" => fake()->dateTimeBetween("-5 years"),
            "microchip_number" => fake()->numberBetween(100000, 999999),
            "date_of_adoption" => fake()->dateTimeBetween('-1 year', 'now'),
            "retainership_plan" => fake()->randomElement(['bronze', 'silver', 'gold', 'custom', 'none']),
            "custom_plan_details" => null,
        ];
    }
}
