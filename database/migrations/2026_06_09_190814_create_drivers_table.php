<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')
                  ->constrained('districts')
                  ->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('phone', 20)->unique();
            $table->string('password', 255);
            $table->enum('status', ['available', 'busy', 'offline'])
                  ->default('offline');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};