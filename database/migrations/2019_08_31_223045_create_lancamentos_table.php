<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->smallInteger('quantidade');
            $table->enum('tipo', ['ENTRADA','SAIDA']);
            
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')
                ->on('users');
    
            $table->bigInteger('produto_id')->unsigned()->nullable();
            $table->foreign('produto_id')
                ->references('id')
                ->on('produtos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
    
            $table->bigInteger('servico_id')->unsigned()->nullable();
            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lancamnetos');
    }
}
