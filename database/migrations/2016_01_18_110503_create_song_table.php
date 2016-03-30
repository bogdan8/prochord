    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongTable extends Migration
{

    public function up()
    {
        Schema::create('song', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->integer('categorySong_id');
            $table->integer('performer_id');
            $table->string('title');
            $table->string('slug');
            $table->longText('body');
            $table->string('description');
            $table->longText('tabulature');
            $table->longText('note');
            $table->string('image');
            $table->longText('video');
            $table->string('media_document');
            $table->string('who_added');
            $table->integer('heart');
            $table->string('address');
            $table->integer('count_views_song');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('song');
    }

}
