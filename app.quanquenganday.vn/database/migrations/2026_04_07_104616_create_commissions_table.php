<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            // Liên kết với bảng users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Số tiền hoa hồng (Dùng decimal để tính toán chính xác hơn float)
            $table->decimal('amount', 15, 2)->default(0);
            
            // Ghi chú (Ví dụ: Hoa hồng từ đơn hàng #123, Thưởng giới thiệu...)
            $table->string('note')->nullable();
            
            // Trạng thái (Nếu sau này Duyqt muốn làm thêm phần Duyệt hoa hồng)
            $table->string('status')->default('received'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};