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
        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_category_id')->nullable()->constrained()->nullOnDelete();

            // User inputs (per product)
            $table->string('product_name');
            $table->string('product_link')->nullable();

            $table->decimal('unit_price_foreign', 12, 2);
            $table->unsignedInteger('quantity')->default(1);

            // Recommend: store total weight for this item line (already qty considered)
            $table->decimal('weight_kg', 10, 3); // total weight for this line

            // Snapshot of duty rate at quote time (category-based)
            $table->decimal('duty_rate_snapshot', 6, 4)->default(0);

            // Computed per item line
            $table->decimal('item_cost_npr', 14, 2)->default(0);
            $table->decimal('shipping_cost_npr', 14, 2)->default(0);
            $table->decimal('cif_npr', 14, 2)->default(0);
            $table->decimal('duty_npr', 14, 2)->default(0);
            $table->decimal('vat_npr', 14, 2)->default(0);
            $table->decimal('total_npr', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
