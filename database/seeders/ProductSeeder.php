<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu cho bảng products
        DB::table('products')->insert([
            [
                'name' => 'Giày Sneakers Nam',
                'slug' => 'giay-sneakers-nam',
                'img_thumb' => 'product-thumb-1.png', // Sử dụng ảnh từ thư mục images
                'description' => 'Giày sneakers nam thoải mái, thời trang.',
                'price' => 500000,
                'price_sale' => 450000,
                'category_id' => 1, // Thuộc danh mục Giày Nam
                'brand_id' => 1, // ID của thương hiệu (Giả sử ID = 1)
                'view' => 100,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Boots Nam',
                'slug' => 'giay-boots-nam',
                'img_thumb' => 'product-thumb-2.png',
                'description' => 'Giày boots nam phong cách, bền bỉ.',
                'price' => 800000,
                'price_sale' => 700000,
                'category_id' => 1, // Thuộc danh mục Giày Nam
                'brand_id' => 1,
                'view' => 120,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Sneakers Nữ',
                'slug' => 'giay-sneakers-nu',
                'img_thumb' => 'product-thumb-3.png',
                'description' => 'Giày sneakers nữ nhẹ nhàng và dễ phối đồ.',
                'price' => 550000,
                'price_sale' => 500000,
                'category_id' => 2, // Thuộc danh mục Giày Nữ
                'brand_id' => 2, // ID của thương hiệu
                'view' => 150,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Cao Gót Nữ',
                'slug' => 'giay-cao-got-nu',
                'img_thumb' => 'product-thumb-4.png',
                'description' => 'Giày cao gót nữ sang trọng, quyến rũ.',
                'price' => 900000,
                'price_sale' => 850000,
                'category_id' => 2, // Thuộc danh mục Giày Nữ
                'brand_id' => 2,
                'view' => 200,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Thể Thao Nam',
                'slug' => 'giay-the-thao-nam',
                'img_thumb' => 'product-thumb-5.png',
                'description' => 'Giày thể thao nam chất lượng cao, thoải mái cho mọi hoạt động.',
                'price' => 600000,
                'price_sale' => 550000,
                'category_id' => 3, // Thuộc danh mục Giày Thể Thao
                'brand_id' => 1, // ID của thương hiệu
                'view' => 80,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Running Nam',
                'slug' => 'giay-running-nam',
                'img_thumb' => 'product-thumb-6.png',
                'description' => 'Giày chạy thể thao nam giúp bạn vượt qua mọi thử thách.',
                'price' => 650000,
                'price_sale' => 600000,
                'category_id' => 3, // Thuộc danh mục Giày Thể Thao
                'brand_id' => 2,
                'view' => 90,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Casual Nam',
                'slug' => 'giay-casual-nam',
                'img_thumb' => 'product-thumb-1.png',
                'description' => 'Giày casual nam nhẹ nhàng, thoải mái cho mọi dịp.',
                'price' => 400000,
                'price_sale' => 350000,
                'category_id' => 4, // Thuộc danh mục Giày Casual
                'brand_id' => 1,
                'view' => 110,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Loafer Nam',
                'slug' => 'giay-loafer-nam',
                'img_thumb' => 'product-thumb-2.png',
                'description' => 'Giày loafer nam thanh lịch, dễ phối đồ.',
                'price' => 500000,
                'price_sale' => 450000,
                'category_id' => 4, // Thuộc danh mục Giày Casual
                'brand_id' => 1,
                'view' => 95,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Loafer Nữ',
                'slug' => 'giay-loafer-nu',
                'img_thumb' => 'product-thumb-3.png',
                'description' => 'Giày loafer nữ thời trang, dễ dàng kết hợp với mọi trang phục.',
                'price' => 550000,
                'price_sale' => 500000,
                'category_id' => 2, // Thuộc danh mục Giày Nữ
                'brand_id' => 2,
                'view' => 160,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

