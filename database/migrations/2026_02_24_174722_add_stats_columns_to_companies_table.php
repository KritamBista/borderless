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
        Schema::table('companies', function (Blueprint $table) {
            //
                    $table->unsignedBigInteger('orders_placed')->default(0);
        $table->unsignedInteger('ecommerce_stores')->default(0);
        $table->unsignedInteger('countries')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
                 $table->dropColumn([
            'orders_placed',
            'ecommerce_stores',
            'countries',
        ]);
        });
    }
};
