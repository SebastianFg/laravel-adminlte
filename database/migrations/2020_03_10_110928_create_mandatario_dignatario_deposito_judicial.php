<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandatarioDignatarioDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandatario_dignatario_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_mandatario_dignatario');
            $table->string('nombre_entidad',100)->nullable();
            $table->string('nombre_mandatario_dignatario',100)->nullable();
            $table->integer('id_detalle_deposito_judicial')->unsigned()->references('id_detalle_deposito_judicial')->on('detalle_asignacion_vehiculos_deposito_judicial');
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
        Schema::dropIfExists('mandatario_dignatario_deposito_judicial');
    }
}
