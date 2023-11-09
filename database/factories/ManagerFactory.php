<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*         while (true) {
            $c = Company::inRandomOrder()->first()->id;
            if (!Manager::firstWhere('company_id', $c)) {
                Log::info('company_id: ' . $c);
                Log::info('check: loop break');
                break;
            }
        } */
        return [
            'name' => fake()->name(),
        ];
    }
}
