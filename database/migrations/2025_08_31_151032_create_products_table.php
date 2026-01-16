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
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // id أساسي
        $table->string('name'); // اسم المنتج
        $table->text('description')->nullable(); // وصف المنتج (ممكن يكون فاضي)
        $table->decimal('price', 10, 2); // السعر
        $table->integer('stock')->default(0); // المخزون
        $table->imeges('img')->nullable(); // صورة المنتج
        $table->string('sku')->unique(); // كود المنتج
        $table->sunsignedTinyInteger('discount_percentage')->default(0); // نسبة الخصم
        $table->unsignedBigInteger('category_id')->nullable(); // لو عندك تصنيفات
        $table->timestamps(); // created_at + updated_at
        $table->boolean('is_new')->default(1); // جديد أو مستعمل
    });
}

public function down(): void
{
    Schema::dropIfExists('products');
}

};
