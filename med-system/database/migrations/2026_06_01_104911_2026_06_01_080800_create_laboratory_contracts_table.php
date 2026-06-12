<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laboratory_contracts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('laboratory_id')->constrained()->onDelete('cascade');
    $table->foreignId('facility_id')->constrained()->onDelete('cascade');
    $table->date('start_date');
    $table->date('end_date')->nullable();
    $table->timestamps();
    
    $table->unique(['laboratory_id', 'facility_id']);
    $table->index('facility_id');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
