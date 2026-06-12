<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['hospital', 'polyclinic']);
            $table->foreignId('parent_hospital_id')->nullable()->constrained('facilities');
            $table->string('address')->nullable();
            $table->timestamps();
            $table->index('type');
            $table->index('parent_hospital_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
