<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siniestros', function (Blueprint $table) {
            $table->bigIncrements('id_siniestro');
            $table->integer('id_vehiculo')->unsigned()->references('id_vehiculo')->on('vehiculos');
            $table->integer('id_dependencia')->unsigned()->references('id_dependencia')->on('dependencias');
            $table->string('observaciones_siniestro');
            $table->string('lugar_siniestro');
            $table->date('fecha_siniestro');
            $table->date('fecha_presentacion');
            $table->string('lesiones_siniestro');
            $table->string('descripcion_siniestro');
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
        Schema::dropIfExists('siniestros');
    }
}
