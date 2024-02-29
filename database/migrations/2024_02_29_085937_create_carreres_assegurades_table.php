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
        Schema::enableForeignKeyConstraints();

        Schema::create('carreres_assegurades', function (Blueprint $table) {
            $table->unsignedBigInteger('idCarrera');
            $table->string('CIFasseguradora');
            $table->primary(['idCarrera', 'CIFasseguradora']);
            
            $table->foreign('idCarrera')->references('idCarrera')->on('carreres')->onDelete('cascade');
            $table->foreign('CIFasseguradora')->references('CIF')->on('asseguradores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreres_assegurades');
    }
};
