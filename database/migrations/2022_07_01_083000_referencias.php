<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Referencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->id();
            $table->string('edad_inicial');
            $table->string('tipo_inicial');
            $table->string('edad_final');
            $table->string('tipo_final');
            $table->string('sexo');
            $table->string('referencia_inicial');
            $table->string('referencia_final');
            $table->string('dias_inicio');
            $table->string('dias_final');

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
        Schema::dropIfExists('referencias');
    }
}
