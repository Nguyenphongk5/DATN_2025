<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Voucher::create([
                'code' => strtoupper(Str::random(8)),
                'discount_type' => $i % 2 === 0 ? 'percent' : 'fixed',
                'discount_value' => $i % 2 === 0 ? rand(5, 20) : rand(10000, 50000),
                'start_date' => Carbon::now()->subDays(rand(1, 5)),
                'end_date' => Carbon::now()->addDays(rand(5, 15)),
                'quantity' => rand(10, 100),
                'used_count' => rand(0, 10),
                'user_limit' => 1,
                'min_money' => 50000,
                'max_money' => 200000,
                'is_active' => 1,
            ]);
        }
    }
}
