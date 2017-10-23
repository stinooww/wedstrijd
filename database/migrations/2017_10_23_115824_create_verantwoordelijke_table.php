<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerantwoordelijkeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verantwoordelijke', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('wedstrijd_id')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('naam');
            $table->boolean('is_deleted');
            $table->foreign('wedstrijd_id')->references('id')->on('wedstrijd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verantwoordelijke');
    }
}
