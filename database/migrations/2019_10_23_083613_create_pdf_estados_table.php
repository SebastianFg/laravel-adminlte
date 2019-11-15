<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_estados', function (Blueprint $table) {
            $table->bigIncrements('id_pdf_estado');
            $table->string('nombre_pdf_estado');
            $table->integer('id_estado_vehiculo')->references('id_estado_vehiculo')->on('estado_vehiculos');

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
        Schema::dropIfExists('pdf_estados');
    }
}
