<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialAsignacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_asignacion', function (Blueprint $table) {
            $table->integer('id_vehiculo')->unsigned();
            $table->unsignedBigInteger('id_dependencia');
            $table->date('fecha');
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('id_responsable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_asignacion');
    }
}
