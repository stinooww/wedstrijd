<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnaarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winnaar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('wedstrijd_id')->unsigned();

            $table->boolean('gekwalificeerd');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('wedstrijd_id')->references('id')->on('wedstrijd')->onDelete('cascade');
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
        Schema::dropIfExists('winnaar');
    }
}
