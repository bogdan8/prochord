<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsCommentTable extends Migration
{

    public function up()
    {
        Schema::create('lessonsComment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lessons_id');
            $table->string('name');
            $table->string('email');
            $table->datetime('date');
            $table->longText('body');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('lessonsComment');
    }

}
