<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->date('data_envio');
            $table->date('data_recebida')->nullable();
            $table->decimal('peso_guia', $precision = 9, $scale = 1)->nullable();
            $table->decimal('volume_guia', $precision = 9, $scale = 1)->nullable();
            $table->enum('tipo', ['Aereo', 'Maritimo'])->default('Aereo');
            $table->enum('estado', ['MIA', 'ADU', 'PWT'])->default('MIA');
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
        Schema::dropIfExists('cargas');
    }
}
