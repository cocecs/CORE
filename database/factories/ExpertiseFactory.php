<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExpertiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $expertises = [
            'Technology & IT',
            'Creative & Design',
            'Business & Administration',
            'Marketing & Sales',
            'Healthcare & Life Sciences',
            'Education & Training',
            'Finance & Legal',
            'Logistics & Supply Chain'
        ];

        return [
            // Generates a unique 2-digit code (e.g., "01", "42")
            'exp_code' => $this->faker->unique(true)->randomElement(range(1, 99)),

            // Picks a realistic name from the list above
            'area_of_expertise' => $this->faker->unique()->randomElement($expertises),
        ];
    }
}
