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
        Schema::create('f1_commission_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Người nhận tiền (cấp trên)
        $table->foreignId('f1_user_id')->constrained('users'); // Người bán (cấp dưới)
        $table->foreignId('order_id')->constrained(); // Đơn hàng phát sinh tiền
        $table->decimal('amount', 15, 2); // Số tiền 5% hoặc tiền cân bằng
        $table->string('type'); // 'f1_5_percent' hoặc 'balanced'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('f1_commission_logs');
    }
};
