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
        Schema::table('outpatient_visits', function (Blueprint $table) {
            $table->text('prescription')
                ->nullable()
                ->after('diagnosis')
                ->comment('Назначение врача');
        });
    }

    public function down(): void
    {
        Schema::table('outpatient_visits', function (Blueprint $table) {
            $table->dropColumn('prescription');
        });
    }
};
