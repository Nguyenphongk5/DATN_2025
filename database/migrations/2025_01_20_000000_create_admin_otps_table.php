<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_otps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('otp', 6); // Mã OTP 6 số
            $table->timestamp('expires_at'); // Thời gian hết hạn
            $table->boolean('is_used')->default(false); // Đã sử dụng chưa
            $table->string('ip_address')->nullable(); // IP address
            $table->string('user_agent')->nullable(); // User agent
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_otps');
    }
}; 