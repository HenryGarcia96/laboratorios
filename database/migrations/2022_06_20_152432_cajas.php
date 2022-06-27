<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cajas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();

            $table->string('apertura')->nullable();
            $table->string('entradas')->nullable();
            $table->string('salidas')->nullable();
            $table->string('ventas_efectivo')->nullable();
            $table->string('ventas_tarjeta')->nullable();
            $table->string('ventas_transferencia')->nullable();
            $table->string('salidas_efectivo')->nullable();
            $table->string('salidas_tarjeta')->nullable();
            $table->string('salidas_transferencia')->nullable();
            $table->string('total')->nullable();
            $table->string('estatus')->nullable();
            
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
