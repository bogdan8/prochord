<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingIpTable extends Migration
{

    public function up()
    {
        Schema::create('votingIp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voting_id');
            $table->string('people_browser');
            $table->string('people_ip');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('votingIp');
    }

}
