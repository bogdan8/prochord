<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChordSong extends Model
{
    protected $table = 'chordSong';

    public function getActive()
    {
        return $this->orderBy('title','asc')->published()->get();
    }

    public function scopePublished($query)
    {

        $query->where(['active' => 1]);

    }

}
