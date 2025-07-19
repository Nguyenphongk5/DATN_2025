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
        Schema::table('order_returns', function (Blueprint $table) {
            $table->text('response_note')->nullable()->after('status'); // phản hồi từ admin
            $table->timestamp('processed_at')->nullable()->after('response_note'); // thời gian xử lý
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_returns', function (Blueprint $table) {
            $table->dropColumn(['response_note', 'processed_at']);
        });
    }
};
