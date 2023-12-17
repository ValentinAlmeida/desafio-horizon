<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBateriasTable extends Migration
{
    /**
     * Executa as operações necessárias para criar a tabela 'baterias'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baterias', function (Blueprint $table) {
            // Chave primária incrementável automática.
            $table->id();
            
            // Chave estrangeira referenciando o 'numero' do surfista1.
            $table->unsignedBigInteger('surfista1');
            $table->foreign('surfista1')->references('numero')->on('surfistas');
            
            // Chave estrangeira referenciando o 'numero' do surfista2.
            $table->unsignedBigInteger('surfista2');
            $table->foreign('surfista2')->references('numero')->on('surfistas');
            
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
        // Dropa a tabela 'baterias' se ela existir.
        Schema::dropIfExists('baterias');
    }
}
