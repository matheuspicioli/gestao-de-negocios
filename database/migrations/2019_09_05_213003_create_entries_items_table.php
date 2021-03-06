<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesItemsTable extends Migration
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

            $table->smallInteger('quantity')->unsigned();

            $table->float('value_recieved', 10, 2)->nullable();
            $table->float('total_value', 10, 2)->nullable();
            $table->float('value_change', 10, 2)->nullable();

            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')
                ->references('id')
                ->on('items');

            $table->bigInteger('entry_id')->unsigned();
            $table->foreign('entry_id')
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
