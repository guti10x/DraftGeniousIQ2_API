<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id('id_player');
            $table->unsignedBigInteger('id_equipo')->nullable();
            $table->text('nombre');
            $table->text('posicion');
            $table->text('equipo')->nullable();
            $table->integer('titular')->nullable();
            $table->integer('transferible')->nullable();
            $table->integer('recomendado')->nullable();
            $table->text('transferido_desde')->nullable();
            $table->integer('edad')->nullable();
            $table->float('altura')->nullable();
            $table->integer('peso')->nullable();
            $table->timestamps();
        });

        Schema::table('jugadores', function (Blueprint $table) {
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
        Schema::dropIfExists('jugadores');
    }
}