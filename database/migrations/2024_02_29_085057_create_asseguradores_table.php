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
        Schema::create('asseguradores', function (Blueprint $table) {
            $table->string('CIF')->primary();
            $table->string('nom');
            $table->boolean('habilitado')->default(true);
            $table->string('adreça');
            $table->float('preuCursa');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asseguradores');
    }
};
