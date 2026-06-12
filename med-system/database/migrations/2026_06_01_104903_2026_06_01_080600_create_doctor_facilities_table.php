<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('doctor_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
            $table->boolean('is_main_job')->default(true);
            $table->enum('role', ['attending', 'consultant'])->default('attending');
            $table->timestamps();
            $table->unique(['doctor_id', 'facility_id']);
            $table->index('facility_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_facilities');
    }
};
