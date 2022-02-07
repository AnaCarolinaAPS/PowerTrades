<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('contato');
            $table->enum('tipo_documento', ['RUC', 'RG', 'SI'])->default('RUC');
            $table->string('numero_documento');
            $table->enum('admin', ['adm', 'log', 'fin'])->nullable();
            $table->enum('nacionalidade', ['BRA', 'PYG', 'EUA'])->default('PYG');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
            $table->dropColumn('nacionalidade');
            $table->dropColumn('contato');
            $table->dropColumn('tipo_documento');
            $table->dropColumn('numero_documento');
        });
    }
}
