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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();

            // Snapshot of country rates at quote time (so old quote doesn't change)
            $table->string('currency_code_snapshot', 10);
            $table->decimal('exchange_rate_to_npr_snapshot', 12, 4);
            $table->decimal('shipping_rate_per_kg_snapshot', 12, 2);
            $table->decimal('service_fee_npr_snapshot', 12, 2);
            $table->decimal('vat_rate_snapshot', 6, 4)->default(0.1300);

            // Quote totals (sum of all items)
            $table->decimal('items_cost_npr_total', 14, 2)->default(0);
            $table->decimal('shipping_npr_total', 14, 2)->default(0);
            $table->decimal('cif_npr_total', 14, 2)->default(0);
            $table->decimal('duty_npr_total', 14, 2)->default(0);
            $table->decimal('vat_npr_total', 14, 2)->default(0);
            $table->decimal('grand_total_npr', 14, 2)->default(0);

            $table->string('status')->default('estimated'); // estimated/confirmed/paid/cancelled
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
