<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'quantity' => 100,
                'used_count' => 0,
                'user_limit' => 1,
                'min_money' => 100000,
                'max_money' => 5000000,
                'is_active' => 1,
            ],
            [
                'code' => 'SAVE50K',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'quantity' => 50,
                'used_count' => 0,
                'user_limit' => 1,
                'min_money' => 200000,
                'max_money' => 3000000,
                'is_active' => 1,
            ],
            [
                'code' => 'SUMMER20',
                'discount_type' => 'percent',
                'discount_value' => 20,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'quantity' => 30,
                'used_count' => 0,
                'user_limit' => 1,
                'min_money' => 300000,
                'max_money' => 2000000,
                'is_active' => 1,
            ],
            [
                'code' => 'NEWUSER',
                'discount_type' => 'fixed',
                'discount_value' => 100000,
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
                'quantity' => 200,
                'used_count' => 0,
                'user_limit' => 1,
                'min_money' => 500000,
                'max_money' => 10000000,
                'is_active' => 1,
            ],
            [
                'code' => 'FLASH15',
                'discount_type' => 'percent',
                'discount_value' => 15,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'quantity' => 20,
                'used_count' => 0,
                'user_limit' => 1,
                'min_money' => 150000,
                'max_money' => 1000000,
                'is_active' => 1,
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
