<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleAsignacionVehiculosDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_asignacion_vehiculos_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_deposito_judicial');
            $table->string('solicitado_deposito_judicial',100);
            $table->string('titular_entrega_deposito_judicial',100);
            $table->string('responsable_deposito_judicial',100);
            $table->string('exp_of',100);
            $table->string('pdf_nombre_exp_of')->nullable();
            $table->unsignedBigInteger('id_responsable')->references('id')->on('users');
            $table->integer('id_vehiculo_deposito_judicial')->unsigned()->references('id_vehiculo_deposito_judicial')->on('vehiculos_deposito_judicial');
            $table->unsignedBigInteger('id_dependencia')->references('id_dependencia')->on('dependencias');
            $table->string('observaciones_deposito_judicial')->nullable();

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
        Schema::dropIfExists('detalle_asignacion_vehiculos_deposito_judicial');
    }
}
