<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
               $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
           $table->foreignId('degree_id')
        ->nullable()
        ->constrained('degrees')
        ->nullOnDelete();
    
    $table->foreignId('academic_title_id')
        ->nullable()
        ->constrained('academic_titles')
        ->nullOnDelete();
            $table->foreignId('specialty_id')->nullable()->constrained('specialties'); 
            $table->integer('experience_years')->default(0);
            $table->decimal('hazard_coeff', 3, 2)->default(0);
            $table->integer('surgeries_performed')->nullable();
            $table->integer('surgeries_fatal')->nullable();
            $table->integer('extra_vacation_days')->default(0);
            $table->timestamps();
            
            $table->index('specialty_id');
            $table->index('degree_id');
            $table->index('academic_title_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
