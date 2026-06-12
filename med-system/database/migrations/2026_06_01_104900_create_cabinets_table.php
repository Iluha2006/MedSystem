<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            
         
            $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
            
     
            $table->foreignId('building_id')->nullable()->constrained('buildings')->onDelete('set null');
            
      
            $table->string('cabinet_number', 20);
            
          
            $table->string('name')->nullable();
            
          
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            
            $table->index('facility_id');
            $table->index('cabinet_number');
            $table->index('is_active');
            $table->unique(['facility_id', 'cabinet_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabinets');
    }
};