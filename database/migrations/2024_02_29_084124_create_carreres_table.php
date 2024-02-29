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
        Schema::create('carreres', function (Blueprint $table) {
            $table->id('idCarrera');
            $table->string('nom');
            $table->string('descripció');
            $table->float('desnivell');
            $table->string('imatgeMapa')->nullable();
            $table->boolean('habilitado')->default(true);
            $table->integer('maximParticipants');
            $table->float('km');
            $table->date('data');
            $table->integer('hora');
            $table->string('puntSortida');
            $table->string('cartellPromoció')->nullable();
            $table->float('preuAsseguradora');
            $table->float('preuPatrocini');
            $table->float('preuInscripció');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreres');
    }
};
