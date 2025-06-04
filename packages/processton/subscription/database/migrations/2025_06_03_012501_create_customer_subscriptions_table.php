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
        Schema::create('customer_subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('customer_id')->nullable()->constrained('customers');
            $table->foreignUuid('item_id')->nullable()->constrained('items')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('active'); // active, cancelled, expired
            $table->dateTime('end_date')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('last_payment_date')->nullable();
            $table->dateTime('next_payment_date')->nullable();
            $table->dateTime('trial_ends_at')->nullable();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->foreignId('currency_id')->constrained('currencies')->onDelete('cascade');
            $table->json('payment_method')->nullable(); // e.g., ['type' => 'card', 'details' => ['card_number' => '**** **** **** 1234']]
            $table->string('frequency')->default('monthly'); // e.g., monthly, yearly
            $table->integer('frequency_interval')->default(1); // e.g., 1 for monthly, 12 for yearly
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_subscriptions');
    }
};
