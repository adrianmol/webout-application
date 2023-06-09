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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->index();
            $table->integer('product_id')->index();
            $table->string('name', 255);
            $table->string('model', 255);
            $table->integer('quantity');
            $table->decimal('price', 16, 4)->default(0.0000);
            $table->decimal('total', 16, 4)->default(0.0000);
            $table->decimal('tax', 16, 4)->default(0.0000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
