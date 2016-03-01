<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongCommentTable extends Migration
{

    public function up()
    {
        Schema::create('songComment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('song_id');
            $table->string('name');
            $table->string('email');
            $table->datetime('date');
            $table->longText('body');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('songComment');
    }

}
