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
        Schema::table('countries', function (Blueprint $table) {
            //
            // Amount above which percentage service fee applies
            $table->decimal('service_fee_threshold_npr', 14, 2)
                ->nullable()
                ->after('service_fee_npr');

            // Percentage fee when threshold exceeded
            $table->decimal('service_fee_percent', 6, 2)
                ->nullable()
                ->after('service_fee_threshold_npr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            //
            $table->dropColumn([
                'service_fee_threshold_npr',
                'service_fee_percent'
            ]);
        });
    }
};
