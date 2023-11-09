<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->sentence(1),
            'hours'=> rand(10,80),
            'price'=> rand(1000,10000),
            'vendor_id'=> Vendor::inRandomOrder()->first()->id,
            'category_id'=> Category::inRandomOrder()->first()->id
        ];
    }
}
