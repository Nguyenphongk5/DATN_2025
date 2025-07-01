<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Logo; // Import model Logo

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logo::truncate();

        Logo::factory()->count(10)->create();

        $this->command->info('Đã tạo 10 logo giả thành công!');
    }
}
