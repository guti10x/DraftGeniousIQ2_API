<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo', function (Blueprint $table) {
            $table->bigIncrements('idEquipo');
            $table->string('nombre', 50);
            $table->integer('puntos')->nullable();
            $table->double('valor')->nullable();
            $table->integer('nJugadores')->nullable();
            $table->double('presupuesto')->nullable();
            $table->bigInteger('idJugador')->unsigned();
            $table->bigInteger('idUsuario')->unsigned();
            $table->bigInteger('idJornada')->unsigned();
            $table->timestamps();

            $table->foreign('idJugador')->references('id')->on('jugadores');
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->foreign('idJornada')->references('id')->on('jornadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo');
    }
}