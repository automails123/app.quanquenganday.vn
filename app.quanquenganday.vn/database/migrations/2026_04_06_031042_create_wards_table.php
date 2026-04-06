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
        Schema::create('wards', function (Blueprint $table) {
            $table->integer('code')->primary(); // Ví dụ: 11953, 11977
            $table->string('name');             // Phường Phố Hiến
            $table->string('division_type');    // phường, xã, đặc khu
            $table->string('codename');         // phuong_pho_hien            
            // Khóa ngoại nối thẳng lên tỉnh vì bạn đã bỏ cấp quận
            $table->integer('province_code'); 
            
            // Đánh Index để Admin lọc quán theo tỉnh cực nhanh
            $table->index('province_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
