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

        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('uid');
            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin_profile')->nullable();  // Link to LinkedIn profile
            $table->string('twitter_handle')->nullable();    // Twitter user handle
            $table->text('notes')->nullable();               // Additional notes or CRM-specific commentary
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('contact_id')->nullable()->constrained('contacts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropColumn('contact_id');
        });

        Schema::dropIfExists('contacts');
    }
};
