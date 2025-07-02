<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        // Nếu chưa có category hoặc brand thì bỏ qua
        if (empty($categories) || empty($brands)) {
            $this->command->warn("Cần seed bảng categories và brands trước.");
            return;
        }

        // Tạo 10 sản phẩm mẫu
        for ($i = 1; $i <= 10; $i++) {
            $name = "Sản phẩm mẫu $i";
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'img_thumb' => 'product_images/sample.jpg',
                'description' => 'Mô tả chi tiết cho ' . $name,
                'price' => rand(100000, 5000000),
                'price_sale' => rand(50000, 4000000),
                'category_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],
                'view' => rand(0, 100),
                'is_active' => rand(0, 1),
            ]);
        }
    }
}

