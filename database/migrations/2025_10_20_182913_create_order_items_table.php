<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // نخلي السعر يا إما يقبل null أو يكون له قيمة افتراضية
            $table->decimal('price', 10, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable(false)->change();
        });
    }
};