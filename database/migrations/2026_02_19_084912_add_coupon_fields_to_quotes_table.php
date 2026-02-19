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
        Schema::table('quotes', function (Blueprint $table) {
            //
            $table->string('coupon_code_snapshot')->nullable();
            $table->string('coupon_type_snapshot')->nullable();   // percent|flat
            $table->decimal('coupon_value_snapshot', 12, 2)->nullable();

            $table->decimal('discount_npr', 14, 2)->default(0);
            $table->decimal('payable_npr', 14, 2)->default(0); // grand_total - discount
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            //
        });
    }
};
