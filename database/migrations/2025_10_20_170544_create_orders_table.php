<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
    // خلي الأعمدة اللي بتعمل مشاكل يقبلوا قيم افتراضية
    $table->string('order_number')->nullable()->change();
    $table->decimal('total_price', 10, 2)->default(0)->change();
    $table->string('status')->default('pending')->change();
    $table->text('notes')->nullable()->change();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};