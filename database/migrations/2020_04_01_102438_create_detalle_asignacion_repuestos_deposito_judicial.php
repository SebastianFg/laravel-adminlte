<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleAsignacionRepuestosDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_asignacion_repuestos_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_repuesto_deposito_judicial');
            $table->integer('id_vehiculo_deposito_judicial')->unsigned()->references('id_vehiculo_deposito_judicial')->on('vehiculos_deposito_judicial');
            $table->dateTime('fecha_deposito_judicial');
            $table->string('repuestos_entregados_deposito_judicial');
            $table->string('pdf_nombre_deposito_judicial',100);
            $table->unsignedBigInteger('id_responsable');
            //fk
            $table->foreign('id_responsable')->references('id')->on('users');
      
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
        Schema::dropIfExists('detalle_asignacion_repuestos_deposito_judicial');
    }
}
