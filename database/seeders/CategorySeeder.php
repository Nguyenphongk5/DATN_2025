<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu cho bảng categories
        DB::table('categories')->insert([
            [
                'name' => 'Giày Nam',
                'parent_id' => null,
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Nữ',
                'parent_id' => null, 
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Thể Thao',
                'parent_id' => null, 
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giày Casual',
                'parent_id' => null, 
                'is_active' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
