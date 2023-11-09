<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        Category::create(['name' => 'technical']);
        //2
        Category::create(['name' => 'English']);

        Category::create(['name' => 'Programming', 'category_id' => 1]);
        Category::create(['name' => 'Office Works', 'category_id' => 1]);
        Category::create(['name' => 'Network', 'category_id' => 1]);

        Category::create(['name' => 'MID', 'category_id' => 2]);
        Category::create(['name' => 'Hard', 'category_id' => 2]);
    }
}
