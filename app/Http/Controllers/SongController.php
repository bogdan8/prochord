<?php

namespace App\Http\Controllers;

use App\Models\AddSong;
use App\Models\CategorySong;
use App\Models\IndexComment;
use App\Models\SongComment;
use App\Models\Voting;
use App\Models\VotingIp;
use App\Models\VotingList;

class SongController extends MainController
{

    public function listCategory(CategorySong $categorySong, IndexComment $indexComment, Voting $voting, VotingList $votingList, VotingIp $votingIp)
    {
        /**-------------------------------------------------------------
         * Add a comment to the category list
         * ----------------------------------------------------------------**/
        if ($this->request->has('body')) {
            $validator = IndexComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $indexComment = new indexComment();
                $indexComment->name = $this->request->get('name');
                $indexComment->email = $this->request->get('email');
                $indexComment->body = $this->request->get('body');
                $indexComment->date = date("Y-m-d h:i:s");
                $indexComment->save();

                return \Response::json([
                    'success' => trans('translation.Ваш_коментар_успішно_добавлений')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End of adding comments to the list of categories
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Sort the list of categories
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['category'] = $categorySong->sortCategory($sort, $sortBy);
        } else {
            $this->data['category'] = $categorySong->getActive();
        }
        /**-------------------------------------------------------------
         * End sort the list of categories
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Voting
         * ----------------------------------------------------------------**/
        $this->data['voting'] = $voting->getActive();
        $this->data['voting_list'] = $votingList->getActive();
        $this->data['votingIp'] = $votingIp->getActive();
        if ($this->request->has('voting_id')) {
            $browser_name = $_SERVER ['HTTP_USER_AGENT'];// Writes to change the name of the browser for statistics
            $voting_id_form = \Input::get('voting_value');// Writing values from form
            $getVotingId = $votingList->getVotingIpCheck($voting_id_form);//Retrieves the ID where it is mentioned on the form
            $voting_id = $getVotingId->voting_id;//Id record in change
            $people_ip = $_SERVER ['REMOTE_ADDR'];
            $getAddress = $votingIp->getActiveCheck($voting_id, $people_ip);// Extracts all the ip addresses and indicators vote for testing
            if ($getAddress) {
                return \Response::json([
                    'success' => false,
                    'errors' => trans('translation.З_вашої_ip_уже_голосували')
                ]);
            } else {
                $votingIp->insertTable($voting_id, $people_ip, $browser_name);// transfer values to record tables
                $getVoting = $votingList->getVoting($voting_id_form);// transfer value from the model form
                $addCount = $getVoting->count + 1;
                $votingList->upVotingListCount($voting_id_form, $addCount);
                /** --------------------------------------------------------------
                 *  Calculates the percentage of the vote
                 * -----------------------------------------------------------------*/
                $sumVotingList = $votingList->sumVotingList($voting_id);// take out a certain sum of Eid
                $voting->upSumVotingList($voting_id, $sumVotingList);//update the field with the amount
                /** --------------------------------------------------------------
                 *  Calculates the percentage of the vote
                 * -----------------------------------------------------------------*/
                return \Response::json([
                    'success' => trans('translation.Ви_успішно_проголосували')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End of voting
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Extracts the most popular and newest category
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $categorySong->most_popular();
        $this->data['last_add'] = $categorySong->last_add();
        /**-------------------------------------------------------------
         * End extracts the most popular and newest category
         * ----------------------------------------------------------------**/
        $this->data['getComments'] = $indexComment->getActive();
        return view('song.listCategory', $this->data);
    }

    public function listSongs()
    {
        /**-------------------------------------------------------------
         * Sorting the list of songs
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['listSongs'] = $this->song->sortSong($sort, $sortBy);
        } else {
            $this->data['listSongs'] = $this->song->getActiveSongs();
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $this->song->most_popular();
        $this->data['performer'] = $this->performer->getActive();
        $this->data['last_add'] = $this->song->last_add();
        if ($this->request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListSong', $this->data)->render());
        }
        return view('song.listSong', $this->data);
    }

    public function listSongsSort($item)
    {
        /**-------------------------------------------------------------
         * Sorting the list of songs
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['listSongs'] = $this->song->sortSongAlphabet($item, $sort, $sortBy);
        } else {
            $this->data['listSongs'] = $this->song->songAlphabet($item);
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $this->song->most_popular_sort($item);
        $this->data['last_add'] = $this->song->last_add_sort($item);
        $this->data['letter'] = $item;
        if ($this->request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListSong', $this->data)->render());
        }
        return view('song.listSong', $this->data);
    }

    public function songsInCategory($title_eng, CategorySong $categorySong)
    {
        /**-------------------------------------------------------------
         * Count the number of hits categories and overwrites data in the database
         * ----------------------------------------------------------------**/
        $getCat = $categorySong->getId($title_eng);
        $idCat = $getCat->id;
        $categorySong->views_increment($idCat);// count the number of hits songs
        $this->data['get'] = $categorySong->getId($title_eng);
        /**-------------------------------------------------------------
         * The end of the count and category views overwrites data in the database
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Sorting the list of songs in categories
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['Song'] = $this->song->sortSongInCategory($idCat, $sort, $sortBy);
        } else {
            $this->data['Song'] = $this->song->getActivePag($idCat);
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs in categories
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $this->song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $this->song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        if ($this->request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.SongsInCategory', $this->data)->render());
        }
        return view('song.songsInCategory', $this->data);

    }

    public function cartSongInCategory($title_eng, $slug, CategorySong $categorySong, SongComment $songComment)
    {
        /**-------------------------------------------------------------
         * Add a comment to song
         * ----------------------------------------------------------------**/
        if ($this->request->has('songId')) {
            $validator = SongComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $songComment = new SongComment();
                $songComment->song_id = $this->request->get('songId');
                $songComment->name = $this->request->get('name');
                $songComment->email = $this->request->get('email');
                $songComment->body = $this->request->get('body');
                $songComment->date = date("Y-m-d h:i:s");
                $songComment->save();

                return \Response::json([
                    'success' => trans('translation.Ваш_коментар_успішно_добавлений')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End add a comment to song
         * ----------------------------------------------------------------**/
        $this->like_song();
        /**-------------------------------------------------------------
         * Count the number of times songs and overwrites data in the database
         * ----------------------------------------------------------------**/
        $id_data = $this->song->oneSong($slug);
        $idSong = $id_data->id;//Ід Пісні
        $this->song->incrementViewsSong($idSong);
        /**-------------------------------------------------------------
         * The end count number of times song and overwrites data in the database
         * ----------------------------------------------------------------**/
        $this->data['get'] = $categorySong->getId($title_eng);
        $this->data['cartSong'] = $this->song->oneSong($slug);
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $idCat = $this->data['get']->id;
        $this->data['most_popular'] = $this->song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $this->song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['songComment'] = $songComment->getActive($idSong);
        $this->data['performer'] = $this->performer->getActive();
        $this->array_tabulature();
        return view('song.cartSong', $this->data);

    }

    public function cartSongs($slug, CategorySong $categorySong, SongComment $songComment)
    {
        /**-------------------------------------------------------------
         * Add narration to song
         * ----------------------------------------------------------------**/
        if ($this->request->has('songId')) {
            $validator = SongComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $songComment = new SongComment();
                $songComment->song_id = $this->request->get('songId');
                $songComment->name = $this->request->get('name');
                $songComment->email = $this->request->get('email');
                $songComment->body = $this->request->get('body');
                $songComment->date = date("Y-m-d h:i:s");
                $songComment->save();

                return \Response::json([
                    'success' => trans('translation.Ваш_коментар_успішно_добавлений')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End of adding comments to songs
         * ----------------------------------------------------------------**/
        $this->like_song();
        /**-------------------------------------------------------------
         * Retrieves category properly that song
         * ---------------------------------------------------------------**/
        $getSong = $this->song->oneSong($slug);
        $idSong = $getSong->id;
        $this->song->incrementViewsSong($idSong);// count the number of hits songs
        /** song ID */
        $id = $getSong->category_song_id;
        /** category ID */
        $this->data['get'] = $categorySong->oneCategory($id);
        /**-------------------------------------------------------------
         * End take out a category that song belongs
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $idCat = $this->data['get']->id;
        $this->data['most_popular'] = $this->song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $this->song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['cartSong'] = $this->song->oneSong($slug);
        $this->data['songComment'] = $songComment->getActive($idSong);
        $this->data['performer'] = $this->performer->getActive();
        $this->array_tabulature();
        return view('song.cartSong', $this->data);

    }

    public function addSong(CategorySong $categorySong)
    {
        /**-------------------------------------------------------------
         * Add narration to song
         * ----------------------------------------------------------------**/
        if ($this->request->has('tabulature')) {
            $validator = AddSong::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $AddSong = new AddSong();
                $AddSong->active = '0';
                $AddSong->title = $this->request->get('name');
                $AddSong->who_added = $this->request->get('you_name');
                $AddSong->slug = $this->request->get('name') . '_user';
                $AddSong->description = $this->request->get('description');
                $AddSong->performer_id = $this->request->get('performer');
                $AddSong->category_song_id = $this->request->get('category');
                $AddSong->tabulature = $this->request->get('tabulature');
                $AddSong->body = $this->request->get('body');
                $AddSong->save();

                return \Response::json([
                    'success' => trans('translation.Ваша_пісня_успішно_додана')
                ]);
            }
        }
        $this->data['category'] = $categorySong->getActive();
        $this->data['performer'] = $this->performer->getActive();
        return view('song.addSong', $this->data);


    }

    public function like_song(){
        /**-------------------------------------------------------------
         * like song
         * ----------------------------------------------------------------**/
        if (isset($_POST['Like'])) {
            $song_id = \Input::get('song_id'); // Id writes songs
            $selectHeart = $this->song->getAddressHeart($song_id);
            $increaseNumber = $selectHeart->heart + 1;
            $selectAddress = $selectHeart->address; // Writes to change ip that is in the database
            $userAddress = $_SERVER ['REMOTE_ADDR']; // Record user ip
            if ($selectAddress == $userAddress) { // Checks ip address that it was impossible to vote 2 times
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                $this->song->addOneHeart($song_id, $increaseNumber, $userAddress);
                $this->data['Like'] = trans('translation.Вам_сподобалось');
            }
        } elseif (isset($_POST['UnLike'])) {
            $song_id = \Input::get('song_id');
            $selectHeart = $this->song->getAddressHeart($song_id);
            $increaseNumber = $selectHeart->heart - 1;
            $selectAddress = $selectHeart->address;
            $userAddress = $_SERVER ['REMOTE_ADDR'];
            if ($selectAddress == $userAddress) {
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                $this->song->addOneHeart($song_id, $increaseNumber, $userAddress);
                $this->data['UnLike'] = trans('translation.Вам_не_сподобалось');
            }
        }
        /** -------------------------------------------------------------
         * End like song
         * ----------------------------------------------------------------**/
    }

    public function array_tabulature()
    {
        return $this->data['arr_letter'] = [
            'Cm', 'C#m', 'Dm', 'D#m', 'Em', 'Fm', 'F#m', 'Bb', 'F#9', 'G9', 'G#9', 'A9', 'B9', 'D#9', 'F9', 'E9',
            'Gm', 'G#m', 'Am', 'Bm', 'Hm7', 'C7', 'C#7', 'D7', 'D#7', 'E7', 'F7', 'F#7', 'G7', 'G#7', 'A7', 'B7', 'H7',
            'm7', 'Cm7', 'C#m7', 'Dm7', 'D#m7', 'Em7', 'Fm7', 'F#m7', 'Gm7', 'G#m7', 'Am7', 'Bm7', 'Hm7', 'maj', 'Cmaj',
            'C#maj', 'Dmaj', 'D#maj', 'Emaj', 'Fmaj', 'F#maj', 'Gmaj', 'G#maj', 'Amaj', 'Bmaj', 'Hmaj', 'dim', 'Cdim', 'C#dim',
            'Ddim', 'D#dim', 'F#dim', 'Gdim', 'G#dim', 'Adim', 'Bdim', 'Hdim', 'C6', 'C#6', 'D6', 'D#6', 'E6', 'F6', 'F#6',
            'G6', 'G#6', 'A6', 'B6', 'H6', 'm6', 'Cm6', 'C#m6', 'Dm6', 'Em6', 'Fm6', 'F#m6', 'Gm6', 'G#m6', 'Am6', 'Bm6', 'Hm6',
            'C4', 'C#4', 'D4', 'D#4', 'E4', 'F4', 'F#4', 'G4', 'G#4', 'A4', 'B4', 'H4', 'm4', 'Cm4', 'C#m4', 'Dm4', 'D#m4', 'Em4',
            'Fm4', 'F#m4', 'Gm4', 'G#m4', 'Am4', 'Bm4', 'Hm4', 'C9', 'C#9', 'D9', 'D#9', 'E9', 'F9', 'H9', 'C', 'C#',
            'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'B', 'Hm'
        ];
    }
}