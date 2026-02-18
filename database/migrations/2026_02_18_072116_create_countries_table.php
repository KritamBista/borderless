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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();          // India, China, Japan, UK, USA, Korea
            $table->string('code', 10)->unique();      // IN, CN, JP, UK, US, KR (your choice)
            $table->string('currency_code', 10);       // INR, CNY, JPY, GBP, USD, KRW

            // Admin-set rates
            $table->decimal('exchange_rate_to_npr', 12, 4); // 1 unit foreign = NPR
            $table->decimal('shipping_rate_per_kg', 12, 2); // NPR per kg
            $table->decimal('service_fee_npr', 12, 2)->default(500);

            // Rules (optional but very useful)
            $table->decimal('min_chargeable_weight_kg', 8, 3)->default(0.500);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
