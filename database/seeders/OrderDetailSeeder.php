<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $variants = ProductVariant::with('product')->get();

        if ($orders->isEmpty() || $variants->isEmpty()) {
            $this->command->warn('⚠️ Chưa có dữ liệu trong `orders` hoặc `product_variants`. Vui lòng seed trước.');
            return;
        }

        $this->command->info('🔁 Bắt đầu seed chi tiết đơn hàng...');

        foreach ($orders as $order) {
            $totalItems = rand(1, 3); // Mỗi đơn có 1–3 sản phẩm

            for ($i = 0; $i < $totalItems; $i++) {
                $variant = $variants->random();

                if (!$variant->product) {
                    $this->command->warn("❌ Variant ID {$variant->id} không có product.");
                    continue;
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product->name,
                    'size_name' => $variant->size,
                    'color_name' => $variant->color_name,
                    'quantity' => rand(1, 5),
                    'price' => $variant->price,
                ]);
            }

            $this->command->info("✅ Đã thêm chi tiết cho đơn hàng #{$order->id}");
        }

        $this->command->info('🎉 Hoàn tất seed `order_details`!');
    }
}
