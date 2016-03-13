<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonsComment extends Model
{
    protected $table = 'lessonsComment';

    public function getActive($id_cart)
    {
        return $this->where(['lessons_id' => $id_cart])->get();

    }

    public function lessons()
    {
        return $this->belongsTo('App\Models\Lessons');
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
