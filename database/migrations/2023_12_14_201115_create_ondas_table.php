<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOndasTable extends Migration
{
    /**
     * Executa as operações necessárias para criar a tabela 'ondas'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ondas', function (Blueprint $table) {
            // Chave primária incrementável automática.
            $table->id();
            
            // Chave estrangeira referenciando o 'id' da bateria.
            $table->unsignedBigInteger('bateria_id');
            $table->foreign('bateria_id')->references('id')->on('baterias');
            
            // Chave estrangeira referenciando o 'numero' do surfista.
            $table->unsignedBigInteger('surfista_id');
            $table->foreign('surfista_id')->references('numero')->on('surfistas');
            
            // Timestamps para rastrear a criação e atualização do registro.
            $table->timestamps();
        });
    }

    /**
     * Reverte as operações realizadas no método 'up'.
     *
     * @return void
     */
    public function down()
    {
        // Dropa a tabela 'ondas' se ela existir.
        Schema::dropIfExists('ondas');
    }
}
