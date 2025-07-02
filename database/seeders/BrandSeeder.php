<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Apple',
                'logo' => 'brand_logos/apple.png',
                'description' => 'Thương hiệu công nghệ nổi tiếng của Mỹ',
            ],
            [
                'name' => 'Samsung',
                'logo' => 'brand_logos/samsung.png',
                'description' => 'Thương hiệu công nghệ hàng đầu Hàn Quốc',
            ],
            [
                'name' => 'Xiaomi',
                'logo' => 'brand_logos/xiaomi.png',
                'description' => 'Thương hiệu Trung Quốc nổi bật với giá rẻ và chất lượng',
            ],
            [
                'name' => 'Sony',
                'logo' => 'brand_logos/sony.png',
                'description' => 'Thương hiệu Nhật Bản nổi tiếng với thiết bị điện tử',
            ],
            [
                'name' => 'Asus',
                'logo' => 'brand_logos/asus.png',
                'description' => 'Thương hiệu mạnh trong lĩnh vực laptop và linh kiện máy tính',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'logo' => $brand['logo'],
                'description' => $brand['description'],
                'is_active' => 1,
            ]);
        }
    }
}
