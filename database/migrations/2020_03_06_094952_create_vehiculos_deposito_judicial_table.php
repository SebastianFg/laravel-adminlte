<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosDepositoJudicialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos_deposito_judicial', function (Blueprint $table) {
            $table->bigIncrements('id_vehiculo_deposito_judicial');
            $table->string('numero_de_referencia_aleatorio_deposito_judicial',50);
            $table->string('numero_de_identificacion_deposito_judicial',50);
            $table->date('fecha_deposito_judicial');
            $table->string('clase_de_unidad_deposito_judicial',100);
            $table->string('marca_deposito_judicial',100);
            $table->string('modelo_deposito_judicial',100);
            $table->string('chasis_deposito_judicial',20);
            $table->string('motor_deposito_judicial',20);
            $table->integer('anio_de_produccion_deposito_judicial');
            $table->string('dominio_deposito_judicial',10);
            $table->bigInteger('kilometraje_deposito_judicial');
            $table->bigInteger('numero_de_inventario_deposito_judicial');
            $table->mediumText('otras_caracteristicas_deposito_judicial');
            $table->tinyInteger('tipo_deposito_judicial');
            $table->softDeletes();
            $table->tinyInteger('baja_deposito_judicial')->default(0);
            $table->integer('id_juzgado')->unsigned()->references('id_juzgado')->on('juzgados');
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
        Schema::dropIfExists('vehiculos_deposito_juducial');
    }
}
