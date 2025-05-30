<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group')->default('Others');
            $table->string('type')->default('text');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('org_key');
            $table->text('org_value')->nullable();
            $table->json('org_options')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orgs');
    }
};
