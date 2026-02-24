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
        // Tạo 10 category cha
        $parentCategories = Category::factory()->count(10)->create();

        // Mỗi category cha tạo 10 category con
        foreach ($parentCategories as $parent) {
            Category::factory()
                ->count(10)
                ->child($parent->id)
                ->create();
        }
    }
}
