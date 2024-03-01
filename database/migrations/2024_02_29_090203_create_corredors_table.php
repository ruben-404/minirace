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
        Schema::create('corredors', function (Blueprint $table) {
            $table->string('DNI')->primary();
            $table->string('nom');
            $table->string('cognoms');
            $table->string('password');
            $table->string('direccio');
            $table->date('dataNaixement');
            $table->string('tipus');
            $table->boolean('soci')->default(false);
            $table->integer('numeroFederat')->nullable();
            $table->integer('punts')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corredors');
    }
};
