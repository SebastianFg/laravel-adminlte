<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandatarioDignatario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandatario_dignatario', function (Blueprint $table) {
            $table->bigIncrements('id_mandatario_dignatario');
            $table->string('nombre_entidad',100)->nullable();
            $table->string('nombre_mandatario_dignatario',100)->nullable();
            $table->integer('id_asignacion')->unsigned()->references('id_detalle')->on('detalle_asignacion_vehiculos');
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
        Schema::dropIfExists('mandatario_dignatario');
    }
}
