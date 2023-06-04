<?php

use App\Models\Manufacturer;
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
            $table->id();
            $table->integer('erp_product_id')->unique()->index();
            $table->string('model', 128)->default('')->index();
            $table->string('sku', 128)->default('');
            $table->string('ean', 128)->default('');
            $table->string('mpn', 128)->default('');
            $table->integer('quantity')->default(0);
            $table->integer('manufacturer_id')->default(0)->foreignIdFor(Manufacturer::class)->index();
            $table->decimal('price', 16, 4)->default(0.0000);
            $table->decimal('wholesale_price', 16, 4)->default(0.0000);
            $table->decimal('price_with_vat', 16, 4)->default(0.0000);
            $table->decimal('vat_perc', 2, 2)->nullable();
            $table->decimal('weight', 16, 4)->default(0.0000);
            $table->tinyInteger('status');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
