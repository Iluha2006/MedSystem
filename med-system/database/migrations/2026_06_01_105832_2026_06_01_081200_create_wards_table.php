<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('ward_number');
            $table->integer('capacity'); 
            $table->timestamps();
            
            $table->index('department_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
