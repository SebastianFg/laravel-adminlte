<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfSiniestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_siniestros', function (Blueprint $table) {
            $table->bigIncrements('id_pdf_siniestro');
            $table->string('nombre_pdf_siniestro');
            $table->integer('id_siniestro')->unsigned()->references('id_siniestro')->on('siniestros');;
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
        Schema::dropIfExists('pdf_siniestros');
    }
}
