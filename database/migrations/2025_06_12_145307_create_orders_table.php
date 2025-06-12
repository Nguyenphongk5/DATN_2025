<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone', 50);
            $table->string('user_address');
            $table->foreignId('voucher_id')->nullable()->constrained();
            $table->decimal('discount_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['cod', 'online'])->default('cod');
            $table->enum('payment_status', ['Unpaid', 'Paid', 'Refunded'])->default('Unpaid');
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->string('shipping_method')->default('standard');
            $table->timestamp('shipped_at')->nullable();
            $table->string('order_code', 100);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
