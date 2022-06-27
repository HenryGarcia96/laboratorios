<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CajasHasSubsidiaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas_has_subsidiaries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('caja_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('laboratory_id');
            $table->unsignedBigInteger('sucursal_id');
            $table->timestamps();

            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sucursal_id')->references('id')->on('subsidiaries')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas_has_subsidiaries');
    }
}
