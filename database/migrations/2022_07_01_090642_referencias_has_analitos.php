<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReferenciasHasAnalitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_has_analitos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analito_id');
            $table->unsignedBigInteger('referencia_id');

            $table->foreign('analito_id')->references('id')->on('analitos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('referencia_id')->references('id')->on('referencias')->onDelete('restrict')->onUpdate('cascade');
            
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
        Schema::dropIfExists('referencias_has_analitos');
    }
}
