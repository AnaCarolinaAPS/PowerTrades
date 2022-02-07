<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique()->nullable();
            $table->enum('nacionalidade', ['BRA', 'PYG', 'EUA'])->default('PYG');
            $table->string('numeracao')->unique();
            $table->string('abreviacao');
            $table->string('referencia')->nullable();
            $table->text('observacoes')->nullable();
            // $table->string('imagem_documento')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('clientes');
    }
}
