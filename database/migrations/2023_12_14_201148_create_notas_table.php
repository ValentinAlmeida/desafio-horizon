<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Executa as operações necessárias para criar a tabela 'notas'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            // Chave primária incrementável automática.
            $table->id();
            
            // Chave estrangeira referenciando o 'id' da onda.
            $table->unsignedBigInteger('onda_id');
            $table->foreign('onda_id')->references('id')->on('ondas');
            
            // Notas parciais atribuídas à onda.
            $table->float('notaParcial1');
            $table->float('notaParcial2');
            $table->float('notaParcial3');
            
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
        // Dropa a tabela 'notas' se ela existir.
        Schema::dropIfExists('notas');
    }
}
