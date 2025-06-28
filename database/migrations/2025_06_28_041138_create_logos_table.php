<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Tên của logo (ví dụ: Logo chính, Logo footer)
            $table->string('image');           // Đường dẫn đến file ảnh logo
            $table->boolean('active')->default(true); // Trạng thái kích hoạt (mặc định là true)
            $table->timestamps();              // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logos');
    }
};
