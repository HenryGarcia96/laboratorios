<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecepcionsHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcions_has_laboratories', function (Blueprint $table){
            $table->id();

            $table->foreignId('recepcions_id')
                    ->nullable()
                    ->constrained('recepcions')
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
        //
    }
}
