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
            // how service fee was applied
            $table->string('service_fee_type')
                ->nullable()
                ->after('service_fee_npr_snapshot'); // flat or percent

            // percentage used
            $table->decimal('service_fee_percent_snapshot', 6, 2)
                ->nullable()
                ->after('service_fee_type');

            // threshold used
            $table->decimal('service_fee_threshold_snapshot', 14, 2)
                ->nullable()
                ->after('service_fee_percent_snapshot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            //
            $table->dropColumn([
                'service_fee_type',
                'service_fee_percent_snapshot',
                'service_fee_threshold_snapshot'
            ]);
        });
    }
};
