<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'song';

    public function getActive()
    {
        $keyword = \Input::get('keyword');
        return $this->where('title', 'LIKE', '%' . $keyword . '%')->orderBy('title', 'asc')->paginate(30);

    }

}
