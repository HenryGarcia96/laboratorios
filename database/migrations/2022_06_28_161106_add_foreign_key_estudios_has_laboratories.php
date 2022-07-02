<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyEstudiosHasLaboratories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudios_has_laboratories', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tecnica_id');
            $table->foreign('tecnica_id')->references('id')->on('tecnicas')->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudios_has_laboratories', function (Blueprint $table) {
            $table->dropForeign('estudios_has_laboratories_tecnica_id_foreign');
        });
    }
}
