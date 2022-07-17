<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistorialsHasAnalitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials_has_analitos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analito_id');
            $table->unsignedBigInteger('historial_id');

            $table->foreign('analito_id')->references('id')->on('analitos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('historial_id')->references('id')->on('historials')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('historials_has_analitos');
    }
}
