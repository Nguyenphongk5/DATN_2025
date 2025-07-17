<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnsTable extends Migration
{
    public function up()
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('reason'); // lý do hoàn hàng (từ dropdown)
            $table->text('note')->nullable(); // ghi chú thêm từ người dùng
            $table->string('image')->nullable(); // ảnh minh họa nếu có
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // trạng thái xử lý
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_returns');
    }
}
