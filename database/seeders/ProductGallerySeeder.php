<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductGallery;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả sản phẩm
        $products = Product::all();

        foreach ($products as $product) {
            // Tạo 2-6 ảnh gallery cho mỗi sản phẩm (tối đa 6 ảnh)
            $galleryCount = rand(2, 6);
            
            for ($i = 0; $i < $galleryCount; $i++) {
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => 'product_galleries/sample-gallery-' . ($i + 1) . '.jpg',
                    'sort_order' => $i
                ]);
            }
        }
    }
}
