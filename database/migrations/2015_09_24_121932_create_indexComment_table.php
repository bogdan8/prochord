<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexCommentTable extends Migration
{

    public function up()
    {
        Schema::create('indexComment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->datetime('date');
            $table->longText('body');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('indexComment');
    }

}
