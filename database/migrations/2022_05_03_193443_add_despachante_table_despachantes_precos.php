<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDespachanteTableDespachantesPrecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('despachantes_precos', function (Blueprint $table) {
            $table->unsignedBigInteger('despachante_id')->default(0);
            $table->foreign('despachante_id')->references('id')->on('despachantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('despachantes_precos', function (Blueprint $table) {
            $table->dropForeign(['despachante_id']);
            $table->dropColumn('despachante_id');
        });
    }
}
