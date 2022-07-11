<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateRecepcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcions', function (Blueprint $table) { 
            $table->id();

            $table->string('folio');
            $table->string('numOrden');
            $table->string('numRegistro');
            //llave foranea-------------------------------
            $table->string('paciente');
            //--------------------------------------------
            $table->string('empresa');
            $table->string('servicio');
            $table->string('tipPasiente');
            $table->string('turno');
            //llave foranea-------------------------------
            $table->string('doctor_id')->nullable();
            $table->string('medico')->nullable();
            //--------------------------------------------
            $table->string('numCama'); 
            $table->string('peso');
            $table->string('talla');
            $table->string('fur')->nullable();
            $table->string('medicamento');
            $table->string('diagnostico');
            $table->string('observaciones')->nullable();
            $table->string('listPrecio')->nullable();
            //$table->string('precTotal');

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
        Schema::dropIfExists('recepcions');
    }
}
