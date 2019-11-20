<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtrasAsignaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otras_asignaciones', function (Blueprint $table) {
            $table->bigIncrements('id_otras_asignaciones');
            $table->string('nombre_entidad_responsable')->nullable();
            $table->string('nombre_persona_responsable')->nullable();
            $table->unsignedBigInteger('id_dependencia');
            //fk
            $table->foreign('id_dependencia')->references('id_dependencia')->on('dependencias');
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
        Schema::dropIfExists('otras_asignaciones');
    }
}
