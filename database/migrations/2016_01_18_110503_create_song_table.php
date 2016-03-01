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
            $table->string('title');
            $table->string('slug');
            $table->integer('categorySong_id');
            $table->longText('body');
            $table->longText('note');
            $table->integer('count_views_song');
            $table->timestamps();
            $table->string('description');
            $table->longText('tabulature');
            $table->string('image');
            $table->longText('video');
            $table->integer('performer_id');
            $table->string('media_document');
            $table->integer('heart');
            $table->string('address');
        });
    }


    public function down()
    {
        Schema::drop('song');
    }

}
