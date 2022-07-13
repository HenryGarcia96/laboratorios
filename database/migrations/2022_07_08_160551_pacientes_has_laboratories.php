<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PacientesHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_has_laboratories', function (Blueprint $table){
            $table->id();

            $table->foreignId('pacientes_id')
                    ->nullable()
                    ->constrained('pacientes')
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
        Schema::dropIfExists('pacientes_has_laboratories');
    }
}
