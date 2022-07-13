<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresasHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_has_laboratories', function (Blueprint $table){
            $table->id();

            $table->foreignId('empresas_id')
                    ->nullable()
                    ->constrained('empresas')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->foreignId('laboratory_id')
                    ->nullable()
                    ->constrained('laboratories')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();                   

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
        Schema::dropIfExists('empresas_has_laboratories');
    }
}
