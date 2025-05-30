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

        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('color',7);
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('regions', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('regions')->after('id');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('color', 7);
            $table->foreignId('region_id')->on('regions')->constrained()->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('iso_2_code', 2)->unique();
            $table->string('iso_3_code', 3)->unique();
            $table->string('dial_code')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->on('countries')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('color', 7);
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('zones', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('zones')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('regions');
    }
};
