<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->integer('size'); // Size in millimeters (e.g., 100 for 10cm, 200 for 20cm)  
            $table->string('color_name');
            $table->string('hex_code', 7);
            $table->integer('quantity'); // Quantity in stock
            $table->decimal('price', 10, 2);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
