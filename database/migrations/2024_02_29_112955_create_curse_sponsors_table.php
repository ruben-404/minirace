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
        Schema::create('curse_sponsors', function (Blueprint $table) {
            // Claves primarias
            $table->string('cifSponsor');
            $table->unsignedBigInteger('idCarrera');
            $table->primary(['cifSponsor', 'idCarrera']);

            // Claves foráneas
            $table->foreign('cifSponsor')->references('CIF')->on('sponsors');
            $table->foreign('idCarrera')->references('idCarrera')->on('carreres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curse_sponsors');
    }
};
