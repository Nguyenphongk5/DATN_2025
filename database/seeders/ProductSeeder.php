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
        $categories = Category::pluck('id', 'slug')->toArray();
        $brands = Brand::pluck('id')->toArray();

        // Kiểm tra có 'phu-kien' và brands
        if (empty($categories['phu-kien']) || empty($brands)) {
            $this->command->warn("Cần seed bảng categories (có 'phu-kien') và brands trước.");
            return;
        }

        $phuKienCategoryId = $categories['phu-kien'];

        for ($i = 1; $i <= 10; $i++) {
            $isAccessory = $i <= 3;

            $name = $isAccessory
                ? "Phụ kiện mẫu $i"
                : "Sản phẩm mẫu $i";

            $description = $isAccessory
                ? "Đây là mô tả chi tiết cho phụ kiện mẫu $i, phù hợp với nhu cầu sử dụng hàng ngày."
                : "Mô tả chi tiết cho sản phẩm mẫu $i";

            $categoryId = $isAccessory
                ? $phuKienCategoryId
                : $categories[array_rand($categories)];

            Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'img_thumb' => 'product_images/sample.jpg',
                'description' => $description,
                'price' => rand(100000, 5000000),
                'price_sale' => rand(50000, 4000000),
                'category_id' => is_numeric($categoryId) ? $categoryId : $categories[$categoryId],
                'brand_id' => $brands[array_rand($brands)],
                'view' => rand(0, 100),
                'is_active' => 1,
            ]);
        }
    }
}
