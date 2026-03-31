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
        Schema::create('shops', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // Tên quán
        // $table->string('type');           // Loại hình (cafe, food...)
        $table->string('owner_name');     // Tên chủ quán
        $table->string('phone');          // Số điện thoại
        $table->string('address_number'); // Số nhà
        $table->string('street');         // Tên đường
        $table->string('ward')->nullable(); // Phường/Xã
        $table->string('city')->nullable(); // Tỉnh/TP
        $table->string('tax_code')->nullable(); // Mã số thuế
        $table->string('gpkd_path')->nullable(); // Đường dẫn ảnh GPKD
        $table->string('cccd_path')->nullable(); // Đường dẫn ảnh CCCD
        $table->decimal('pos_price', 15, 2)->default(1800000);
        $table->foreignId('sale_id')->constrained('users'); 
        $table->string('status')->default('pending');
        $table->timestamps();
    });     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
