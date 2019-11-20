<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_historial');
            $table->integer('id_vehiculo')->unsigned();
            $table->unsignedBigInteger('id_dependencia');
            $table->tinyInteger('tipo_historial')->unsigned();
            $table->dateTimeTz('fecha');
            //fk
            $table->foreign('id_dependencia')->references('id_dependencia')->on('dependencias');
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
        Schema::dropIfExists('historial_vehiculos');
    }
}
