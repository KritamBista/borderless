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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Branding
            $table->string('name')->nullable();
            $table->string('logo')->nullable();          // stored path
            $table->string('preview_image')->nullable(); // OG / social preview image path

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();   // comma-separated keywords

            // Hero section
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();

            // Global settings
            // Store as 13.00 (percent) OR store as 0.1300 (rate). Pick ONE style.
            $table->decimal('vat_percent', 6, 2)->default(13.00);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
