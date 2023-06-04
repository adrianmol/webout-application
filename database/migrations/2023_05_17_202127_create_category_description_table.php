<?php

use App\Models\Category;
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
        Schema::create('category_description', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->foreignIdFor(Category::class)->index();
            $table->integer('language_id');
            $table->string('name', 255)->fullText();
            $table->string('code', 100)->default('')->fullText();
            $table->text('description')->nullable();
            $table->index(['category_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_description');
    }
};
