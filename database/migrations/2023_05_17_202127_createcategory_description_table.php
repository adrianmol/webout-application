<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_description', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->integer('language_id');
            $table->string('name', 255);
            $table->string('code', 100);
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
