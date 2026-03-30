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
        $table->string('name');
        $table->string('owner_name');
        $table->string('phone');
        $table->string('address');
        $table->string('type'); // cafe, food, milktea
        $table->foreignId('sale_id')->constrained('users'); // Sale nào giới thiệu quán này
        $table->string('status')->default('pending'); // pending, active
        $table->decimal('pos_price', 15, 2)->default(1800000);
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
