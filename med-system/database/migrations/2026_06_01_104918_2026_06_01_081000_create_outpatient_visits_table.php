<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('outpatient_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
             $table->foreignId('assigned_cabinet_id')->nullable()->constrained('cabinets')->nullOnDelete();
                $table->foreignId('facility_id')->nullable()->constrained()->nullOnDelete();
                 $table->text('complaint')->nullable();  
            $table->text('diagnosis')
                ->nullable()
                ->comment('Диагноз');
            
    
   
            $table->string('status', 20)
                ->default('scheduled')
                ->comment('scheduled|confirmed|cancelled|completed');
            $table->dateTime('visit_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outpatient_visits');
    }
};
