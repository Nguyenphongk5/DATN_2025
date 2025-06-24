<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\OrderDetail;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $variants = ProductVariant::with('product')->get(); // giả định có quan hệ `product`

        if ($orders->isEmpty() || $variants->isEmpty()) {
            $this->command->warn('Chưa có dữ liệu trong orders hoặc product_variants. Hãy seed trước.');
            return;
        }

        foreach ($orders as $order) {
            $totalItems = rand(1, 3); // mỗi đơn có 1-3 sản phẩm

            for ($i = 0; $i < $totalItems; $i++) {
                $variant = $variants->random();
                $price = $variant->price;
                $quantity = rand(1, 5);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product->name,
                    'size_name' => $variant->size,
                    'color_name' => $variant->color_name,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }
        }
    }
}
