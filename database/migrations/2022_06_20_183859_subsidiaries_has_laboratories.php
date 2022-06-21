<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubsidiariesHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiaries_has_laboratories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('laboratorio_id');
            $table->unsignedBigInteger('sucursal_id');
            $table->timestamps();
            
            $table->foreign('laboratorio_id')->references('id')->on('laboratories')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('subsidiaries_has_laboratories');
    }
}
