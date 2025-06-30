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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identifier')->nullable();
            $table->boolean('is_personal')->default(false);

            $table->boolean('enable_portal')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->foreignId('creator_id')->nullable()->constrained('users');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignUuid('contact_id')->nullable()->constrained('contacts')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
