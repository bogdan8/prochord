<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    protected $table = 'lessons';

    /**-------------------------------------------------------------
     * I make the connection between tables
     * ----------------------------------------------------------------**/

    public function lessonsComment()
    {
        return $this->hasMany('App\Models\LessonsComment');
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/

    public function incrementLesson($id_cart){
        return $this->where('id', '=', $id_cart)->increment('viewed_lesson');
    }

    public function getAll()
    {
        return $this->get();
    }

    public function cart($id)
    {
        return $this->where(['id' => $id])->firstOrFail();
    }

}
