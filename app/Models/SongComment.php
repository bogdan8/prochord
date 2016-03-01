<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SongComment extends Model
{
    protected $table = 'songComment';

    public function getActive($idSong)
    {
        return $this->where(['song_id' => $idSong])->get();

    }

    public function song()
    {
        return $this->belongsTo('App\Models\Song');
    }


    public static $rules = array(
        'name' => 'required|min:2|max:100',
        'email' => 'required|email',
        'body' => 'required|min:5'
    );

    public static function validate($date)
    {
        return \Validator::make($date, static::$rules);
    }


}
