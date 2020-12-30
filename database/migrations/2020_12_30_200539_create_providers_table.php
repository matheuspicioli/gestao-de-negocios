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
            $table->string('company_name');
            $table->string('fantasy_name');
            $table->string('cnpj', 14);
            $table->string('email')->unique();
            $table->string('segment')->nullable();
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
