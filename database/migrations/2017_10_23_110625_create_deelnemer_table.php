<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeelnemerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deelnemer', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('wedstrijd_id')->unsigned();
            $table->foreign('wedstrijd_id')->references('id')->on('wedstrijd')->onDelete('cascade');

            $table->string('firstname');
            $table->string('lastname');
            $table->string('street');
            $table->string('streetnumber');
            $table->integer('postcode');
            $table->string('email');
            $table->string('question');
            $table->boolean('is_deleted')->default(0);
            $table->boolean('qualified')->default(0);
            $table->ipAddress('ip')->unique();
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
        Schema::dropIfExists('deelnemer');
    }
}
