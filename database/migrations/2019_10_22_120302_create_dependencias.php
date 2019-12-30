<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->bigIncrements('id_dependencia');
            $table->string('nombre_dependencia',150)->unique();
            $table->tinyInteger('nivel_dependencia');
            $table->integer('id_padre_dependencia');
            $table->integer('id_municipio');
            $table->softDeletes();
            $table->timestamps();

            //fk
            $table->foreign('id_padre_dependencia')->references('id_dependencia')->on('dependencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependencias');
    }
}
