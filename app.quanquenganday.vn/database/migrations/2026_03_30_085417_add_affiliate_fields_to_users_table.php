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
        // Thêm các trường cần thiết sau cột 'email'
        $table->string('affiliate_id')->unique()->nullable()->after('email'); 
        $table->foreignId('parent_id')->nullable()->after('affiliate_id')->constrained('users')->onDelete('set null');
        $table->text('path')->nullable()->after('parent_id'); 
        $table->integer('level')->default(1)->after('path');
        $table->string('role')->default('sale')->after('level'); // admin, sale, manager
        $table->decimal('balance', 15, 2)->default(0)->after('role');
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
