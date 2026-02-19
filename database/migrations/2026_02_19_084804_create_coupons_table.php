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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. NEWUSER10
            $table->string('type')->default('percent'); // percent|flat
            $table->decimal('value', 12, 2); // percent: 10.00, flat: 500.00

            $table->decimal('min_order_npr', 14, 2)->nullable(); // optional
            $table->decimal('max_discount_npr', 14, 2)->nullable(); // optional cap for percent type

            $table->unsignedInteger('usage_limit')->nullable(); // total usage
            $table->unsignedInteger('used_count')->default(0);

            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
