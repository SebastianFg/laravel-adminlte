<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiniestroDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siniestros_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_siniestro_deposito_judicial');
            $table->integer('id_vehiculo_deposito_judicial')->unsigned()->references('id_vehiculo_deposito_judicial')->on('vehiculos_deposito_judicial');
            $table->integer('id_dependencia')->unsigned()->references('id_dependencia')->on('dependencias');
            $table->string('observaciones_siniestro_deposito_judicial');
            $table->string('lugar_siniestro_deposito_judicial');
            $table->date('fecha_siniestro_deposito_judicial');
            $table->date('fecha_presentacion_deposito_judicial');
            $table->string('lesiones_siniestro_deposito_judicial');
            $table->string('descripcion_siniestro_deposito_judicial');
            $table->integer('id_usuario')->unsigned()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siniestros_deposito_judicial');
    }
}
