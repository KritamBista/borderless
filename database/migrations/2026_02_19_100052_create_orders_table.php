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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Unique public ID (like ORD-2024-00001)
            $table->string('unique_order_id')->unique();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 1 Quote = 1 Order (prevent duplicate submission)
            $table->foreignId('quote_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            $table->foreignId('address_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('payment_method_id')
                ->constrained()
                ->cascadeOnDelete();

            // Payment proof
            $table->string('payment_proof_path');
            $table->boolean('payment_proof_uploaded')->default(true);

            $table->decimal('grand_total_npr', 14, 2);
            $table->decimal('discount_npr', 14, 2)->default(0);
            $table->decimal('payable_npr', 14, 2);

            // Order Status
            $table->enum('status', [
                'pending_verification',
                'payment_verified',
                'payment_rejected',
                'processing',
                'shipping',
                'out_for_delivery',
                'delivered',
                'cancelled'
            ])->default('pending_verification');

            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
