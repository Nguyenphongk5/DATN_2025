
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Thêm các thương hiệu mẫu vào bảng brands
        DB::table('brands')->insert([
            [
                'name' => 'Nike',
                'slug' => Str::slug('Nike'),
                'logo' => 'nike-logo.png', // Cung cấp giá trị cho logo
                'description' => 'Thương hiệu giày nổi tiếng',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas',
                'slug' => Str::slug('Adidas'),
                'logo' => 'adidas-logo.png', // Cung cấp giá trị cho logo
                'description' => 'Thương hiệu thể thao hàng đầu',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
