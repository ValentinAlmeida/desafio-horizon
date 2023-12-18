<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurfistasTable extends Migration
{
    /**
     * Executa as operações necessárias para criar a tabela 'surfistas'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surfistas', function (Blueprint $table) {
            // Chave primária única para o surfista.
            $table->id('numero');
            
            // Nome do surfista.
            $table->string('nome');
            
            // País de origem do surfista.
            $table->string('pais');
            
            // Timestamps para rastrear a criação e atualização do registro.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte as operações realizadas no método 'up'.
     *
     * @return void
     */
    public function down()
    {
        // Dropa a tabela 'surfistas' se ela existir.
        Schema::dropIfExists('surfistas');
    }
}