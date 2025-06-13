<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        $parents = Category::factory()->count(10)->create();

        foreach ($parents as $parent) {
            Category::factory()->count(3)->create([
                'parent_id' => $parent->id,
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
