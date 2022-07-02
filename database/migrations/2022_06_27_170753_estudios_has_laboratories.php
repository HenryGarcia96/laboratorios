<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstudiosHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudios_has_laboratories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudio_id');
            $table->unsignedBigInteger('laboratory_id');
            $table->unsignedBigInteger('sucursal_id');
            
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('muestra_id');
            $table->unsignedBigInteger('recipiente_id');
            $table->unsignedBigInteger('metodo_id');

            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sucursal_id')->references('id')->on('subsidiaries')->onDelete('restrict')->onUpdate('cascade');
            
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('muestra_id')->references('id')->on('muestras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('recipiente_id')->references('id')->on('recipientes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('metodo_id')->references('id')->on('metodos')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('estudios_has_laboratories');
    }
}
