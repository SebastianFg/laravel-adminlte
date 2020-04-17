<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfSiniestrosDepositoJudicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_siniestros_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_pdf_siniestro_deposito_judicial');
            $table->string('nombre_pdf_siniestro_deposito_judicial');
            $table->integer('id_siniestro_deposito_judicial')->unsigned()->references('id_siniestro_deposito_judicial')->on('siniestros_deposito_judicial');;
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
        Schema::dropIfExists('pdf_siniestros_deposito_judicial');
    }
}
