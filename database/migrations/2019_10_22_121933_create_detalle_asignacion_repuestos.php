<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleAsignacionRepuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_asignacion_repuestos', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_repuesto');
            $table->unsignedBigInteger('id_vehiculo');
            $table->dateTime('fecha');
            $table->string('repuestos_entregados');
            $table->string('pdf_nombre',100);
            $table->unsignedBigInteger('id_responsable');
            //fk
            $table->foreign('id_responsable')->references('id')->on('users');
      
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
        Schema::dropIfExists('detalle_asignacion_repuestos');
    }
}
