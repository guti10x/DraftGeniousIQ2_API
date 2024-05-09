<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrediccionesPuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predicciones_puntos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_player');
            $table->float('valor')->nullable();
            $table->timestamps();
        });

        Schema::table('predicciones_puntos', function (Blueprint $table) {
            $table->foreign('id_player')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predicciones_puntos');
    }
}