<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetActivitySchedule>
 */
class PetActivityScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "report" => $this->faker->paragraph(3),
            "pet_id" => "1", // changeable
            "employee_id" => "1", // changeable
            "next_visit_date" => now()->addWeeks(2),
            "treatment_or_vaccinations" => $this->faker->sentence(3),
        ];
    }
}
