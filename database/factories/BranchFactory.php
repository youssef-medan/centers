<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies_ids = Company::pluck('id')->toArray();
        return [
            'name' => fake()->streetName,
            'location' => fake()->streetAddress,
            'mobile' => fake()->phoneNumber(),
            // 'company_id' => Company::inRandomOrder()->first()->id,
            'company_id' => fake()->randomElement($companies_ids),

        ];
    }
}
