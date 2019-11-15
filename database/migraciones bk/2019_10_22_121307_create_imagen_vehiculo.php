<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagen_vehiculo', function (Blueprint $table) {
            $table->Increments('id_imagen');
            $table->string('nombre_imagen')->unique();
            $table->dateTimeTz('fecha');
            $table->unsignedBigInteger('id_vehiculo');
            //fk
            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('vehiculos');
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
        Schema::dropIfExists('imagen_vehiculo');
    }
}
