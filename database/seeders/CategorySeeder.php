<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Danh mục cha
        $electronics = Category::create([
            'name' => 'Điện tử',
            'slug' => Str::slug('Điện tử'),
            'is_active' => 1,
        ]);

        $fashion = Category::create([
            'name' => 'Thời trang',
            'slug' => Str::slug('Thời trang'),
            'is_active' => 1,
        ]);

        $accessory = Category::create([
            'name' => 'Phụ kiện',
            'slug' => Str::slug('Phụ kiện'),
            'is_active' => 1,
        ]);

        // Danh mục con
        Category::create([
            'name' => 'Điện thoại',
            'slug' => Str::slug('Điện thoại'),
            'parent_id' => $electronics->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Laptop',
            'slug' => Str::slug('Laptop'),
            'parent_id' => $electronics->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Nam',
            'slug' => Str::slug('Nam'),
            'parent_id' => $fashion->id,
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Nữ',
            'slug' => Str::slug('Nữ'),
            'parent_id' => $fashion->id,
            'is_active' => 1,
        ]);
    }
}
