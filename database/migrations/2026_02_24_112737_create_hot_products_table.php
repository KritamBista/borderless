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
        Schema::create('hot_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->string('currency', 10)->default('USD');

            $table->string('product_url')->nullable();

            $table->string('origin_country')->nullable();
            // example: USA, China, India

            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(true);

            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hot_products');
    }
};
