<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\ChordSong;
use App\Models\Search;

class IndexController extends MainController
{

    public function chords(ChordSong $chordSong)
    {
        $this->data['chordSong'] = $chordSong->getActive();

        return view('pages.chordSong', $this->data);
    }

    public function search(Search $search ,Song $song)
    {
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['search'] = $song->sortSong($sort, $sortBy);
        } else {
            $this->data['search'] = $song->getActiveSongs();
        }
        $this->data['most_popular'] = $song->most_popular();
        $this->data['last_add'] = $song->last_add();
        $this->data['search'] = $search->getActive();

        return view('pages.search', $this->data);
    }
}