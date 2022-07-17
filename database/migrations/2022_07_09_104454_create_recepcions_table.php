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
            //$table->string('paciente');
            $table->foreignId('id_paciente')
            ->nullable()
            ->constrained('pacientes')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            //--------------------------------------------
            //$table->foreign('id_empresas')->references('id')->on('empresas');
            $table->foreignId('id_empresa')
                    ->nullable()
                    ->constrained('empresas')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            $table->string('servicio');
            $table->string('tipPasiente');
            $table->string('turno');
            //llave foranea-------------------------------
            $table->foreignId('id_doctor')
            ->nullable()
            ->constrained('doctores')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            //--------------------------------------------
            $table->string('numCama')->nullable(); 
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();
            $table->string('fur')->nullable();
            //nuevos--------------------------------------
            $table->string('f_flebotomia')->nullable();
            $table->string('num_vuelo')->nullable();
            $table->string('pais_destino')->nullable();
            $table->string('aerolinea')->nullable();
            //--------------------------------------------
            $table->string('medicamento')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('listPrecio')->nullable();
            
            $table->string('num_total');

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
