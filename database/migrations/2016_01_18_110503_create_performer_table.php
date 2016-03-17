<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performer', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->string('title');
            $table->string('title');
            $table->date('birth');
            $table->string('country');
            $table->string('place');
            $table->string('image');
            $table->longText('description');
            $table->longText('description_rus');
            $table->longText('description_eng');
            $table->integer('count_views_performer');
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
        Schema::drop('performer');
    }
}
