<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('tracknumber');
            $table->date('data_recebimento');
            $table->integer('ctd_caixas')->default(1);
            $table->decimal('peso_eua', $precision = 9, $scale = 1);
            $table->decimal('peso_pyg', $precision = 9, $scale = 1)->nullable();
            $table->decimal('peso_cli', $precision = 9, $scale = 1)->nullable();
            $table->dateTime('data_retirada')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
