<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Danh mục cha
        $electronics = Category::create([
            'name' => 'Điện tử',
            'is_active' => 1,
        ]);

        $fashion = Category::create([
            'name' => 'Thời trang',
            'is_active' => 1,
        ]);

        // Danh mục con
        Category::create([
            'name' => 'Điện thoại',
            'parent_id' => $electronics->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Laptop',
            'parent_id' => $electronics->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Nam',
            'parent_id' => $fashion->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Nữ',
            'parent_id' => $fashion->id,
            'is_active' => 1,
        ]);
    }
}
