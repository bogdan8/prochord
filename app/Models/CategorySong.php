<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySong extends Model
{
    protected $table = 'categorySong';
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
     * Extracts all categories with a limit of 30
     * ----------------------------------------------------------------**/
    public function getActive()
    {
        return $this->published()->orderBy('title', 'asc')->get();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data to sort and sort the list of categories
     * ----------------------------------------------------------------**/
    public function sortCategory($sort, $sortBy)
    {
        return $this->published()->orderBy($sort, $sortBy)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves one category with a specific headline
     * ----------------------------------------------------------------**/
    public function getId($title_eng)
    {
        return $this->where(['title_eng' => $title_eng])->firstOrFail();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves one category
     * ----------------------------------------------------------------**/
    public function oneCategory($id)
    {
        return $this->where(['id' => $id])->firstOrFail();
    }

    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories are most viewed
     * ----------------------------------------------------------------**/
        public function most_popular()
    {
        return $this->published()->orderBy('count_views_cat', 'desc')->take(3)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories have been added last
     * ----------------------------------------------------------------**/
    public function last_add()
    {
        return $this->published()->orderBy('created_at', 'desc')->take(3)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * increases the value of the field hits one
     * ----------------------------------------------------------------**/
    public function views_increment($idCat)
    {
        return $this->where('id', '=', $idCat)->increment('count_views_cat');


    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/

    public function scopePublished($query)
    {

        $query->where(['active' => 1]);

    }

}
