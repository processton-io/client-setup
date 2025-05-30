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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Company name
            $table->string('domain')->nullable();            // Company domain name
            $table->string('phone')->nullable();             // General phone number
            $table->string('website')->nullable();           // Web address
            $table->string('industry')->nullable();          // Industry type (e.g., Software, Retail, etc.)
            $table->decimal('annual_revenue', 15, 2)->nullable();  // Annual revenue
            $table->integer('number_of_employees')->nullable();    // Employee count
            $table->string('lead_source')->nullable();       // How the company was acquired (referral, ad, etc.)
            $table->text('description')->nullable();         // Company description or notes

            $table->foreignId('creator_id')->nullable()->constrained('users'); // ID of the user who created the record
            $table->foreignId('address_id')->nullable()->constrained('addresses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
