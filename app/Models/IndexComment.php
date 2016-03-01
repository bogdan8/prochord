<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexComment extends Model
{
    protected $table = 'indexComment';

    public function getActive()
    {
        return $this->get();

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
