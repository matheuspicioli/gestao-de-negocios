<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo')->nullable();
            $table->string('name');
            $table->string('cpf', 11);
            $table->string('rg', 35)->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('genre_id');
            $table->text('observations')->nullable();
            $table->boolean('active')->default(true);

            $table->bigInteger('address_id')
                ->unsigned()
                ->nullable();
            $table->bigInteger('phone_id')
                ->unsigned()
                ->nullable();

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses');

            $table->foreign('phone_id')
                ->references('id')
                ->on('phones');

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
        Schema::dropIfExists('providers');
    }
}
