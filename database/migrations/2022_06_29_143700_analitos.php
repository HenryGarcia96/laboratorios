<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Analitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analitos', function (Blueprint $table) {
            $table->id();
            $table->string('clave');
            $table->string('descripcion');
            $table->string('bitacora');
            $table->string('defecto');
            $table->string('unidad');
            $table->string('digito');
            $table->string('tipo_resultado')->nullable();

            $table->string('valor_referencia')->nullable();
            $table->string('tipo_referencia')->nullable();
            $table->string('tipo_validacion')->nullable();

            $table->string('numero_uno')->nullable();
            $table->string('numero_dos')->nullable();

            $table->string('documento')->nullable();
            // $table->string('valor_referencia')->nullable();
            $table->string('imagen')->nullable();

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
        Schema::dropIfExists('analitos');
    }
}
