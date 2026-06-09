<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_token', 64)->unique();
            $table->string('customer_phone', 20);
            $table->text('original_message');
            $table->text('normalized_request')->nullable();
            $table->enum('task_type', [
                'medicine_delivery',
                'food_delivery',
                'grocery_delivery',
                'document_delivery',
                'shop_delivery',
                'taxi_request',
                'other'
            ]);
            $table->string('area_text', 150);
            $table->foreignId('area_id')
                  ->nullable()
                  ->constrained('areas')
                  ->nullOnDelete();
            $table->string('area_name', 100)->nullable();
            $table->foreignId('district_id')
                  ->nullable()
                  ->constrained('districts')
                  ->nullOnDelete();
            $table->string('district_name', 100)->nullable();
            $table->foreignId('governorate_id')
                  ->nullable()
                  ->constrained('governorates')
                  ->nullOnDelete();
            $table->string('governorate_name', 100)->nullable();
            $table->enum('resolution_method', [
                'exact_alias',
                'fuzzy_match',
                'unresolved'
            ])->nullable();
            $table->text('exact_address');
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('price_source', [
                'area',
                'district',
                'governorate',
                'default'
            ])->nullable();
            $table->foreignId('assigned_driver_id')
                  ->nullable()
                  ->constrained('drivers')
                  ->nullOnDelete();
            $table->enum('status', [
                'pending',
                'driver_assigned',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};