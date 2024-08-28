<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "employee_id" => "DPW/employee/".fake()->unique()->numberBetween(0, 100000),
            // "documents" => fake()->unique()->,
            "status" => "active",
            "employment_date" => now(),
            "is_admin" => fake()->boolean(20),
            "user_id" => "1", // change
        ];
    }
}
