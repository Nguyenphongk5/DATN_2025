<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'title' => 'Phong Cách',
            'image' => 'images/slide-1.jpg',
            'is_active' => true,
        ]);

        Banner::create([
            'title' => 'Cá tính',
            'image' => 'images/slide-2.jpg',
            'is_active' => true,
        ]);

        Banner::create([
            'title' => 'Mạnh Mẽ',
            'image' => 'images/slide-3.jpg',
            'is_active' => true,
        ]);

        Banner::create([
            'title' => 'Thời Thượng',
            'image' => 'images/slide-4.jpg',
            'is_active' => true,
        ]);
    }
}

