<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'song';

    /**-------------------------------------------------------------
     * I make the connection between tables
     * ----------------------------------------------------------------**/
    public function categorySong()
    {
        return $this->belongsTo('App\Models\CategorySong');
    }

    public function performer()
    {
        return $this->belongsTo('App\Models\Performer');
    }

    public function songComment()
    {
        return $this->hasMany('App\Models\SongComment');
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Extracts all songs
     * ----------------------------------------------------------------**/
    public function getActive()
    {
        return $this->published()->get();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Extracts all songs 30
     * ----------------------------------------------------------------**/
    public function getActiveSongs()
    {
        return $this->published()->paginate(30);
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves song as belonging to a particular category
     * ----------------------------------------------------------------**/
    public function getActivePag($idCat)
    {
        return $this->where(['active' => '1', 'category_song_id' => $idCat])->paginate(30);
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data sorting and sorts the list of songs in certain categories
     * ----------------------------------------------------------------**/
    public function sortSongInCategory($idCat, $sort, $sortBy)
    {
        return $this->where(['active' => '1', 'category_song_id' => $idCat])->orderBy($sort, $sortBy)->paginate(30);

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data sorting and sorts song list
     * ----------------------------------------------------------------**/
    public function sortSong($sort, $sortBy)
    {
        return $this->published()->orderBy($sort, $sortBy)->paginate(30);

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data to sort songs and sort the list by letter
     * ----------------------------------------------------------------**/
    public function songAlphabet($item)
    {
        return $this->published()->where('title', 'like', $item . '%')->paginate(30);

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Transmits data to sort songs and sort the list by letter
     * ----------------------------------------------------------------**/
    public function sortSongAlphabet($item, $sort, $sortBy)
    {
        return $this->published()->where('title', 'like', $item . '%')->orderBy($sort, $sortBy)->paginate(30);

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories are most viewed and sorted by a particular letter
     * ----------------------------------------------------------------**/
    public function most_popular_sort($item)
    {
        return $this->published()->where('title', 'like', $item . '%')->orderBy('count_views_song', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories have been added and last for some sort bukvvoyu
     * ----------------------------------------------------------------**/
    public function last_add_sort($item)
    {
        return $this->published()->where('title', 'like', $item . '%')->orderBy('created_at', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Extracts a song
     * ----------------------------------------------------------------**/
    public function oneSong($slug)
    {
        return $this->where(['active' => '1', 'slug' => $slug])->firstOrFail();
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Extracts a song for the artist
     * ----------------------------------------------------------------**/
    public function SongPerformer($idPerformer)
    {
        return $this->where(['active' => '1', 'performer_id' => $idPerformer])->paginate(30);
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories are most viewed
     * ----------------------------------------------------------------**/
    public function most_popular()
    {
        return $this->published()->orderBy('count_views_song', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves categories have been added last
     * ----------------------------------------------------------------**/
    public function last_add()
    {
        return $this->published()->orderBy('created_at', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves a list of songs that are most accessed in a particular category
     * ----------------------------------------------------------------**/
    public function most_popular_songInCategory($idCat)
    {
        return $this->where(['active' => '1', 'category_song_id' => $idCat])->orderBy('count_views_song', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Retrieves a list of songs that were added last to a certain category
     * ----------------------------------------------------------------**/
    public function last_add_songInCategory($idCat)
    {
        return $this->where(['active' => '1', 'category_song_id' => $idCat])->orderBy('created_at', 'desc')->take(5)->get();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Adding value to each field I liked
     * ----------------------------------------------------------------**/
    public function addOneHeart($song_id, $increaseNumber, $userAddress)
    {
        return $this->where('id', '=', $song_id)->UPDATE(
            ['heart' => $increaseNumber, 'address' => $userAddress]
        );

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * take out a song with margins address and heart
     * ----------------------------------------------------------------**/
    public function getAddressHeart($song_id)
    {
        return $this->SELECT('heart', 'address')->WHERE('id', '=', $song_id)->first();

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * increment count_views_song
     * ----------------------------------------------------------------**/
    public function incrementViewsSong($idSong)
    {
        return $this->where('id', '=', $idSong)->increment('count_views_song');

    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
    /**-------------------------------------------------------------
     * Scope
     * ----------------------------------------------------------------**/
    public function scopePublished($query)
    {
        $query->where(['active' => '1']);
    }
    /**-------------------------------------------------------------
     * End
     * ----------------------------------------------------------------**/
}
