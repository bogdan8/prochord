<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddSong extends Model
{
    protected $table = 'song';

    /**-------------------------------------------------------------
     * Витягую всі пісні до 30
     * ----------------------------------------------------------------**/
    public function getActiveSongs()
    {
        return $this->published()->get();
    }
    /**-------------------------------------------------------------
     * Кінець
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Scope
     * ----------------------------------------------------------------**/
    public function scopePublished($query)
    {
        $query->where(['active' => '1']);
    }

    /**-------------------------------------------------------------
     * Кінець
     * ----------------------------------------------------------------**/
    public static $rules = array(
        'name' => 'required|min:2|max:100',
        'description' => 'required|min:2|max:100',
        'tabulature' => 'required|min:2|max:300',
        'body' => 'required|min:5'
    );

    public static function validate($date)
    {
        return \Validator::make($date, static::$rules);
    }
}
