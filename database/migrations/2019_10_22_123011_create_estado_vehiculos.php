<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_estado_vehiculo');
            $table->integer('id_vehiculo')->nullable()->unsigned();
            $table->integer('tipo_estado_vehiculo')->unsigned()->nullable();
            $table->unsignedBigInteger('id_usuario_movimiento');
            //fk
            $table->foreign('id_usuario_movimiento')->references('id')->on('users');
            $table->string('estado_razon')->nullable();
            $table->dateTime('estado_fecha');
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
        Schema::dropIfExists('estado_vehiculos');
    }
}
