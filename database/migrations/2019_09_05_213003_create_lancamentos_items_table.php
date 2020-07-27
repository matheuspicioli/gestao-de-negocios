<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLancamentosItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedSmallInteger('quantity');

            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->bigInteger('lancamento_id')->unsigned();
            $table->foreign('lancamento_id')
                ->references('id')
                ->on('entries');

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
        Schema::dropIfExists('entries_items');
    }
}
