<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleAsignacionVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_asignacion_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_detalle');
            $table->integer('id_vehiculo')->unsigned();
            $table->unsignedBigInteger('id_dependencia');
            $table->dateTimeTz('fecha');
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('id_responsable');
    
            //fk
            $table->foreign('id_responsable')->references('id')->on('users');
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
        Schema::dropIfExists('detalle_asignacion_vehiculos');
    }
}
