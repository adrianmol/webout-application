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
        Schema::create('product_discount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->index();
            $table->integer('customer_group_id')->default('1');
            $table->string('code', 64);
            $table->smallInteger('priority')->default('0');
            $table->decimal('price', 16, 4)->default(0.0000);
            $table->decimal('percentage', 2, 2)->default(0.00);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_discount');
    }
};
