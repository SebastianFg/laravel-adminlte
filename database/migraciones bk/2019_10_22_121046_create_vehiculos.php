<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_vehiculo');
            $table->string('numero_de_identificacion',100)->unique();
            $table->date('fecha');
            $table->string('clase_de_unidad',100);
            $table->string('marca',100);
            $table->string('modelo',100);
            $table->string('chasis',100)->unique();
            $table->string('motor',100)->unique();
            $table->integer('anio_de_produccion');
            $table->string('dominio',100)->unique();
            $table->bigInteger('kilometraje');
            $table->string('tipo_identificacion',10)->default('JP');
            $table->bigInteger('numero_de_inventario')->unique();
            $table->mediumText('otras_caracteristicas');
            $table->tinyInteger('tipo');
            $table->softDeletes();
            $table->tinyInteger('baja')->default(0);
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
        Schema::dropIfExists('vehiculos');
    }
}
