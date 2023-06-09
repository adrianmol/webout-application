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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('store_order_id');
            $table->integer('erp_order_id')->nullable()->index();
            $table->integer('store_id')->nullable()->index();
            $table->string('store_name', 128)->nullable();
            $table->string('store_url', 128)->nullable();
            $table->integer('customer_id');
            $table->integer('customer_group_id');
            $table->boolean('is_invoice_order')->default(false);
            $table->string('firstname', 128);
            $table->string('lastname', 128);
            $table->string('email', 128);
            $table->string('telephone', 128);
            $table->string('vat_number', 128)->nullable();
            $table->string('doy', 128)->nullable();
            $table->string('profession', 128)->nullable();
            $table->string('payment_firstname', 128);
            $table->string('payment_lastname', 128);
            $table->string('payment_company', 128);
            $table->string('payment_address', 128);
            $table->string('payment_city', 128);
            $table->string('payment_postcode', 32);
            $table->string('payment_country', 64);
            $table->integer('payment_country_id');
            $table->string('payment_zone', 64);
            $table->string('payment_method', 64);
            $table->string('payment_code', 64);
            $table->string('shipping_firstname', 128);
            $table->string('shipping_lastname', 128);
            $table->string('shipping_company', 128);
            $table->string('shipping_address', 128);
            $table->string('shipping_city', 64);
            $table->string('shipping_postcod', 32);
            $table->string('shipping_country', 128);
            $table->integer('shipping_country_id');
            $table->string('shipping_zone', 64);
            $table->string('shipping_method', 64);
            $table->string('shipping_code', 64);
            $table->string('comment', 255)->nullable();
            $table->decimal('total', 16, 4)->default(0.0000);
            $table->integer('order_status_id');
            $table->integer('erp_status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
