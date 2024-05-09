<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadisticasJornadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticas_jornadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_player');
            $table->integer('jornada');
            $table->integer('puntuacion_fantasy')->nullable();
            $table->integer('puntuacion_as')->nullable();
            $table->integer('puntuacion_marca')->nullable();
            $table->float('media_puntos_visitante')->nullable();
            $table->float('media_puntos_local')->nullable();
            $table->integer('valor_mercado')->nullable();
            $table->text('ultimo_rival')->nullable();
            $table->text('resultado_del_partido')->nullable();
            $table->text('proximo_rival')->nullable();
            $table->text('proximo_partido_es_local')->nullable();
            $table->integer('balones_en_largo_totales')->nullable();
            $table->integer('ocasiones_claras_falladas')->nullable();
            $table->integer('tiros_bloqueados_en_defensa')->nullable();
            $table->integer('entradas_como_último_hombre')->nullable();
            $table->float('goles_evitados')->nullable();
            $table->integer('salidas_precisas')->nullable();
            $table->integer('minutos_jugados')->nullable();
            $table->float('goles_esperados')->nullable();
            $table->integer('balones_en_largo_precisos')->nullable();
            $table->integer('intercepciones')->nullable();
            $table->integer('tiros_fuera')->nullable();
            $table->integer('tiros_bloqueados_en_ataque')->nullable();
            $table->integer('posesiones_perdidas')->nullable();
            $table->integer('paradas_desde_dentro_del_área')->nullable();
            $table->integer('centros_totales')->nullable();
            $table->integer('entradas_totales')->nullable();
            $table->integer('despejes_por_alto')->nullable();
            $table->integer('duelos_aéreos_perdidos')->nullable();
            $table->integer('duelos_ganados')->nullable();
            $table->integer('pases_totales')->nullable();
            $table->integer('penaltis_cometidos')->nullable();
            $table->float('asistencias_esperadas')->nullable();
            $table->integer('pérdidas')->nullable();
            $table->integer('regates_totales')->nullable();
            $table->integer('penaltis_provocados')->nullable();
            $table->integer('despejes_con_los_puños')->nullable();
            $table->integer('goles')->nullable();
            $table->integer('asistencias_de_gol')->nullable();
            $table->integer('tiros_al_palo')->nullable();
            $table->integer('regates_completados')->nullable();
            $table->integer('ocasiones_creadas')->nullable();
            $table->integer('penaltis_fallados')->nullable();
            $table->integer('pases_clave')->nullable();
            $table->integer('tiros_a_puerta')->nullable();
            $table->integer('fueras_de_juego')->nullable();
            $table->integer('centros_precisos')->nullable();
            $table->integer('errores_que_llevan_a_disparo')->nullable();
            $table->integer('despejes_totales')->nullable();
            $table->integer('duelos_aéreos_ganados')->nullable();
            $table->integer('paradas')->nullable();
            $table->integer('pases_precisos')->nullable();
            $table->integer('toques')->nullable();
            $table->integer('duelos_perdidos')->nullable();
            $table->integer('faltas_recibidas')->nullable();
            $table->integer('errores_que_llevan_a_gol')->nullable();
            $table->integer('salidas_totales')->nullable();
            $table->integer('penaltis_parados')->nullable();
            $table->integer('regateado')->nullable();
            $table->integer('faltas_cometidas')->nullable();
            $table->timestamps();
        });

        Schema::table('estadisticas_jornadas', function (Blueprint $table) {
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
        Schema::dropIfExists('estadisticas_jornadas');
    }
}