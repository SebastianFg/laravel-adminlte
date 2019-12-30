<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->bigIncrements('id_municipio');
            $table->string('nombre_municipio',100);
            $table->string('nombre_departamento',100)->nullable();
            $table->bigInteger('poblacion')->nullable();
            $table->bigInteger('varones')->nullable();
            $table->bigInteger('mujeres')->nullable();
            $table->string('zona',50)->nullable();
            $table->string('ur',20)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('municipios');
    }
}
