<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the governorates table.
     * This is the top level of the Lebanese geographic hierarchy.
     * governorates → districts → areas → area_aliases
     */
    public function up(): void
    {
        Schema::create('governorates', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 100);
            $table->string('name_en', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drops the governorates table.
     */
    public function down(): void
    {
        Schema::dropIfExists('governorates');
    }
};