<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Đảm bảo có category
        $categoryId = DB::table('categories')->value('id');
        if (!$categoryId) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => 'Default Category',
                'parent_id' => null,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Đảm bảo có brand
        $brandId = DB::table('brands')->value('id');
        if (!$brandId) {
            $brandId = DB::table('brands')->insertGetId([
                'name' => 'Default Brand',
                'slug' => Str::slug('Default Brand'),
                'logo' => 'default.png',
                'description' => 'Default brand description',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tạo product
        $productId = DB::table('products')->insertGetId([
            'name' => 'T-Shirt Red',
            'slug' => Str::slug('T-Shirt Red'),
            'img_thumb' => 'tshirt.jpg',
            'description' => 'Red T-shirt, comfortable cotton',
            'price' => 150000,
            'price_sale' => 120000,
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'view' => 0,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm các biến thể sản phẩm
        DB::table('product_variants')->insert([
            [
                'product_id' => $productId,
                'size' => 'M',
                'color_name' => 'Red',
                'hex_code' => '#FF0000',
                'quantity' => 20,
                'price' => 150000,
                'price_sale' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => $productId,
                'size' => 'L',
                'color_name' => 'Red',
                'hex_code' => '#FF0000',
                'quantity' => 15,
                'price' => 150000,
                'price_sale' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
