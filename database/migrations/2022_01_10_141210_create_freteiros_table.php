<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreteirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freteiros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('nacionalidade', ['BRA', 'PYG', 'EUA'])->default('PYG');
            $table->enum('tipo_documento', ['RUC', 'RG', 'SI'])->default('RUC');
            $table->string('numero_documento');
            $table->string('contato');
            $table->string('referencia')->nullable();
            $table->text('observacoes')->nullable();
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
        Schema::dropIfExists('freteiros');
    }
}
