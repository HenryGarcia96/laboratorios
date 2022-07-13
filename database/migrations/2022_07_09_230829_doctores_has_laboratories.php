<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoctoresHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctores_has_laboratories', function (Blueprint $table){
            $table->id();

            $table->foreignId('doctores_id')
                    ->nullable()
                    ->constrained('doctores')
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
        Schema::dropIfExists('doctores_has_laboratories');
    }
}
