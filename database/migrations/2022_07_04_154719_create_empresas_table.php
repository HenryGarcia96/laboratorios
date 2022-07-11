<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->string('clave');
            $table->string('descripcion')->nullable();
            $table->string('calle');
            $table->string('colonia');
            $table->string('ciudad');
            $table->string('telefono');
            $table->string('rfc');
            $table->string('email');
            $table->string('contacto');
            $table->string('list_precios');
            $table->string('usuario');
            $table->string('password');

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
        Schema::dropIfExists('empresas');
    }
}
