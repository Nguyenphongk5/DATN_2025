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
        Schema::table('vouchers', function (Blueprint $table) {
            if (!Schema::hasColumn('vouchers', 'quantity')) {
                $table->integer('quantity')->default(0);
            }
            if (!Schema::hasColumn('vouchers', 'user_limit')) {
                $table->integer('user_limit')->default(1);
            }
            if (!Schema::hasColumn('vouchers', 'min_money')) {
                $table->decimal('min_money', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('vouchers', 'max_money')) {
                $table->decimal('max_money', 10, 2)->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            if (Schema::hasColumn('vouchers', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('vouchers', 'user_limit')) {
                $table->dropColumn('user_limit');
            }
            if (Schema::hasColumn('vouchers', 'min_money')) {
                $table->dropColumn('min_money');
            }
            if (Schema::hasColumn('vouchers', 'max_money')) {
                $table->dropColumn('max_money');
            }
        });
    }
};
