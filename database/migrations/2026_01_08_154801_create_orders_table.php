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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // người mua
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // khóa học
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            // giá tại thời điểm mua
            $table->decimal('price', 10, 2);

            // trạng thái đơn
            $table->enum('status', [
                'pending',   // chờ duyệt
                'paid',      // đã duyệt -> tính doanh thu
                'rejected',  // từ chối
                'cancelled'  // hủy
            ])->default('pending');

            // phương thức thanh toán
            $table->string('payment_method')->nullable(); 
            // bank, momo, zalopay, qr

            // mã giao dịch
            $table->string('transaction_code')->nullable();

            // admin duyệt
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // thời gian duyệt
            $table->timestamp('approved_at')->nullable();

            // ghi chú admin
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
