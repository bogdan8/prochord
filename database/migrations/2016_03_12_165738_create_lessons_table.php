<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_lesson', 11);
            $table->string('title');
            $table->string('title_rus');
            $table->string('title_eng');
            $table->longText('body');
            $table->longText('body_rus');
            $table->longText('body_eng');
            $table->datetime('date');
            $table->integer('viewed_lesson', 11);
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
        Schema::drop('lessons');
    }
}
