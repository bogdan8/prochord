<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alphabet extends Model
{
    protected $table = 'alphabet';

    public function getActive()
    {
        return $this->published()->get();
    }

    public function scopePublished($query)
    {
        $query->where(['active' => '1']);
    }
}
