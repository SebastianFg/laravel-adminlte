<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialAsignacionDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_asignacion_deposito_judicial', function (Blueprint $table) {
            $table->integer('id_vehiculo_deposito_judicial')->unsigned();
            $table->unsignedBigInteger('id_dependencia');
            $table->date('fecha_deposito_judicial');
            $table->string('observaciones_deposito_judicial')->nullable();
            $table->unsignedBigInteger('id_responsable_deposito_judicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_asignacion_deposito_judicial');
    }
}
