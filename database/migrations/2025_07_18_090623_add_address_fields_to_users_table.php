<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'province')) {
                $table->string('province')->nullable();
            }
            if (!Schema::hasColumn('users', 'district')) {
                $table->string('district')->nullable();
            }
            if (!Schema::hasColumn('users', 'ward')) {
                $table->string('ward')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['province', 'district', 'ward', 'address']);
        });
    }
};
