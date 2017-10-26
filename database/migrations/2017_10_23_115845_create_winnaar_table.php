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
            $table->integer('deelnemer_id')->unsigned();

            $table->boolean('disqualified')->default(0);
            $table->foreign('deelnemer_id')->references('id')->on('deelnemer')->onDelete('cascade');

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
