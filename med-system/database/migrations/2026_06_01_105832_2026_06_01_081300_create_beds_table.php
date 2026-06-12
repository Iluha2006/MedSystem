<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards')->onDelete('cascade');
            $table->string('bed_number');
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();
            
            $table->index(['ward_id', 'is_occupied']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beds');
    }
};
