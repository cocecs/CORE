<?php

namespace Database\Factories;
use App\Models\Expertise;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expertise>
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
        return [
            'exp_code' => $this->faker->unique(),
            // 'exp_code' => $this->generateUniqueSlug(),
            'area_of_expertise' => $this->faker->unique(),
        ];
    }
    private function generateUniqueSlug(): string
    {
        do {
            $exp_code = Str::lower(Str::random(5));
        } while (Expertise::where('exp_code', $exp_code)->exists());

        return $exp_code;
    }

}
