<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $voucherIds = Voucher::pluck('id')->toArray(); // nếu có vouchers

        if ($users->isEmpty()) {
            $this->command->warn("Không có user nào. Vui lòng seed user trước.");
            return;
        }

        $statuses = ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'];
        $paymentMethods = ['cod', 'online'];
        $paymentStatuses = ['Unpaid', 'Paid', 'Refunded'];

        for ($i = 1; $i <= 20; $i++) {
            $user = $users->random();

            $discount = rand(0, 100000);
            $shipping = rand(15000, 40000);
            $total = rand(300000, 1000000);

            Order::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_phone' => '09' . rand(10000000, 99999999),
                'user_address' => '123 Đường số ' . rand(1, 100) . ', Quận ' . rand(1, 12),
                'voucher_id' => rand(0, 1) ? ($voucherIds[array_rand($voucherIds)] ?? null) : null,
                'discount_amount' => $discount,
                'total_amount' => $total,
                'status' => $statuses[array_rand($statuses)],
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $paymentStatuses[array_rand($paymentStatuses)],
                'shipping_fee' => $shipping,
                'shipping_method' => 'standard',
                'shipped_at' => now()->subDays(rand(0, 5)),
                'order_code' => strtoupper(Str::random(10)),
                'note' => fake()->boolean(50) ? 'Giao hàng giờ hành chính' : null,
            ]);
        }
    }
}
