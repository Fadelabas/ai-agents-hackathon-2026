<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')
                  ->nullable()
                  ->constrained('areas')
                  ->cascadeOnDelete();
            $table->foreignId('district_id')
                  ->nullable()
                  ->constrained('districts')
                  ->cascadeOnDelete();
            $table->foreignId('governorate_id')
                  ->nullable()
                  ->constrained('governorates')
                  ->cascadeOnDelete();
            $table->decimal('price', 8, 2);
            $table->enum('pricing_level', ['area', 'district', 'governorate', 'default']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_prices');
    }
};