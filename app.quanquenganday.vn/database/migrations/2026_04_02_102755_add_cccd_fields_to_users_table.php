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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cccd_front_image')->nullable(); // Ảnh mặt trước
            $table->string('cccd_back_image')->nullable();  // Ảnh mặt sau
            $table->string('cccd_status')->default('pending'); // pending, approved, rejected
            $table->timestamp('cccd_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
