<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    protected $table = 'performer';
    protected $fillabre = ['title'];

    /**-------------------------------------------------------------
     * I make the connection between the table songs
     * ----------------------------------------------------------------**/
    public function song()
    {
        return $this->hasMany('App\Models\Song');
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves all artists
     * ----------------------------------------------------------------**/
    public function getActive()
    {
        return $this->published()->orderBy('title', 'asc')->get();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves all performers with a limit of 30
     * ----------------------------------------------------------------**/
    public function getActivePag()
    {
        return $this->published()->paginate(15);
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves one artist by name
     * ----------------------------------------------------------------**/
    public function onePerformer($slug)
    {
        return $this->where(['active' => '1', 'slug' => $slug])->firstOrFail();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves one artist by id
     * ----------------------------------------------------------------**/
    public function onePerformerId()
    {
        return $this->where(['active' => '1', 'id' => '1'])->firstOrFail();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data sorting and sorts the list of artists
     * ----------------------------------------------------------------**/
    public function sortPerformer($sort, $sortBy)
    {
        return $this->published()->orderBy($sort, $sortBy)->paginate(15);

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Artists who pulls most viewed
     * ----------------------------------------------------------------**/
    public function most_popular()
    {
        return $this->published()->orderBy('count_views_performer', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Extracts performers have been added last
     * ----------------------------------------------------------------**/
    public function last_add()
    {
        return $this->published()->orderBy('created_at', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * increment count_views_performer
     * ----------------------------------------------------------------**/
    public function increment_views_performer($idPerformer)
    {
        return $this->where('id', '=', $idPerformer)->increment('count_views_performer');

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    public function scopePublished($query)
    {

        $query->where(['active' => 1]);

    }

}
