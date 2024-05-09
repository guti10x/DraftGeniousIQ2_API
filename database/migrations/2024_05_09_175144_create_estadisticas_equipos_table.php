<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadisticasEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticas_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_equipo')->nullable();
            $table->integer('puntos')->nullable();
            $table->integer('money')->nullable();
            $table->float('media_puntos_jornada')->nullable();
            $table->float('valor')->nullable();
            $table->integer('num_jugadores')->nullable();
            $table->timestamps();
        });

        Schema::table('estadisticas_equipos', function (Blueprint $table) {
            $table->foreign('id_equipo')->references('id')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadisticas_equipos');
    }
}