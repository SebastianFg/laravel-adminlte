<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagenesVehiculosJudiciales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_vehiculos_judicial', function (Blueprint $table) {
            $table->Increments('id_imagen');
            $table->string('nombre_imagen')->unique();
            $table->dateTimeTz('fecha');
            $table->unsignedBigInteger('id_vehiculo_deposito_judicial');
            //fk
            $table->foreign('id_vehiculo_deposito_judicial')->references('id_vehiculo_deposito_judicial')->on('vehiculos_deposito_judicial');
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
        //
    }
}
