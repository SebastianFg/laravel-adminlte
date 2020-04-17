<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoVehiculosDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_vehiculos_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_estado_vehiculo_deposito_judicial');
            $table->integer('id_vehiculo_deposito_judicial')->unsigned()->references('id_vehiculo_deposito_judicial')->on('vehiculos_deposito_judicial');
            $table->integer('tipo_estado_vehiculo_deposito_judicial')->unsigned()->nullable();
            $table->unsignedBigInteger('id_usuario_movimiento');
            //fk
            $table->foreign('id_usuario_movimiento')->references('id')->on('users');
            $table->string('estado_razon_deposito_judicial')->nullable();
            $table->string('estado_decreto_deposito_judicial')->nullable();
            $table->dateTime('estado_fecha_deposito_judicial');
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
        Schema::dropIfExists('estado_vehiculos_deposito_judicial');
    }
}
