<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{

    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->integer('weight');
            $table->string('image');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('slides');
    }

}
