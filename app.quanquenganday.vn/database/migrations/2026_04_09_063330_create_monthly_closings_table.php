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
        Schema::create('monthly_closings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Thời gian chốt
            $table->integer('month');
            $table->integer('year');

            // Chỉ số bán hàng
            $table->integer('personal_pos_count')->default(0); // Số POS cá nhân bán
            $table->integer('team_pos_count')->default(0);     // Tổng POS của F1

            // Chi tiết các loại hoa hồng (Dùng decimal để tránh sai số làm tròn)
            $table->decimal('direct_commission', 15, 2)->default(0);  // Trực tiếp 270k/máy
            $table->decimal('kpi_bonus', 15, 2)->default(0);         // Thưởng KPI (100k, 300k...)
            $table->decimal('balanced_bonus', 15, 2)->default(0);    // Cân bằng (min mình và F1)
            $table->decimal('system_pool_bonus', 15, 2)->default(0); // Thưởng hệ thống (2%, 3%, 5%)
            $table->decimal('f1_share_bonus', 15, 2)->default(0);    // 5% thu nhập từ F1
            $table->decimal('area_bonus', 15, 2)->default(0);        // Thưởng khu vực (nếu có)
            
            // Tổng thu nhập cuối cùng
            $table->decimal('total_earnings', 15, 2)->default(0);

            // Trạng thái thanh toán
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            // Index để tìm kiếm nhanh khi Sale xem lịch sử
            $table->index(['user_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_closings');
    }
};
