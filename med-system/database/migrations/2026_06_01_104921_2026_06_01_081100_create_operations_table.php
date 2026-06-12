<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            
       
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('facility_id')->nullable()->constrained('facilities')->onDelete('set null');
            
  
            $table->dateTime('operation_date');
        
           
            $table->string('name')->nullable();              
            $table->string('operation_type')->nullable();  
            $table->text('diagnosis')->nullable();           
            $table->text('description')->nullable();         
            
         
            $table->enum('result', ['planned', 'successful', 'complicated', 'fatal'])->default('planned');
            $table->boolean('is_fatal')->default(false);
            
         
            $table->text('complications')->nullable();
            
          
            
            $table->timestamps();
            
         
            $table->index('doctor_id');
            $table->index('patient_id');
            $table->index('facility_id');
            $table->index(['doctor_id', 'is_fatal']);
            $table->index(['doctor_id', 'operation_date']);
            $table->index(['patient_id', 'operation_date']);
            $table->index('operation_date');
            $table->index('result');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};