<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')
                  ->constrained('areas')
                  ->cascadeOnDelete();
            $table->string('alias', 150);
            $table->enum('language_type', ['arabic', 'english', 'franco', 'typo']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_aliases');
    }
};