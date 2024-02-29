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
        Schema::create('sponsors', function (Blueprint $table) {
            // Clave primaria
            $table->string('CIF')->primary();
            
            // Otros campos
            $table->string('nom');
            $table->string('logo');
            $table->string('adreça');
            $table->boolean('destacat')->default(false); // Valor por defecto 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
