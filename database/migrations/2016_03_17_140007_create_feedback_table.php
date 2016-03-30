<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('role');
            $table->string('name');
            $table->string('email');
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('feedback');
    }
}
