<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('domicilio');
            $table->string('colonia');
            $table->string('sexo');
            $table->string('fecha_nacimiento');
            $table->string('celular');
            $table->string('email');
            $table->string('empresa');
            $table->string('seguro_popular');
            $table->string('vigencia_inicio');
            $table->string('vigencia_fin');
            $table->string('usuario');
            $table->string('password');
            //$table->string('medico')->nullable();

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
        Schema::dropIfExists('pacientes');
    }
}
