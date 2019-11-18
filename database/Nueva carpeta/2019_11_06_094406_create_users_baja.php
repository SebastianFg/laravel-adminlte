<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_baja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo',255);
            $table->integer('id_usuario_movimiento');
            $table->integer('id_usuario');
            $table->timestamps();


            //fk 
            $table->foreign('id_usuario_movimiento')->references('id')->on('users');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_baja');
    }
}
