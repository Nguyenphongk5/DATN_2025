<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant  ;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn("Không có sản phẩm nào. Vui lòng seed bảng products trước.");
            return;
        }

        $colors = [
            ['name' => 'Đỏ', 'hex' => '#FF0000'],
            ['name' => 'Xanh lá', 'hex' => '#00FF00'],
            ['name' => 'Xanh dương', 'hex' => '#0000FF'],
            ['name' => 'Đen', 'hex' => '#000000'],
            ['name' => 'Trắng', 'hex' => '#FFFFFF'],
        ];

        $sizes = [100, 150, 200, 250, 300]; // mm (10cm, 15cm...)

        foreach ($products as $product) {
            $variantCount = rand(2, 5); // Tạo 2–5 biến thể cho mỗi sản phẩm

            for ($i = 0; $i < $variantCount; $i++) {
                $color = $colors[array_rand($colors)];
                $size = $sizes[array_rand($sizes)];
                $price = $product->price;
                $priceSale = $product->price_sale ?? null;

                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'color_name' => $color['name'],
                    'hex_code' => $color['hex'],
                    'quantity' => rand(5, 50),
                    'price' => $price,
                    'price_sale' => $priceSale,
                ]);
            }
        }
    }
}
