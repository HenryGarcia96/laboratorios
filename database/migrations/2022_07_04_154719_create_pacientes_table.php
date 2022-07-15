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
            $table->string('domicilio')->nullable();
            $table->string('colonia')->nullable();
            $table->string('sexo');
            $table->string('fecha_nacimiento');
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('id_empresa')
                    ->nullable()
                    ->constrained('empresas')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->string('seguro_popular')->nullable();
            $table->string('vigencia_inicio')->nullable();
            $table->string('vigencia_fin')->nullable();
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
