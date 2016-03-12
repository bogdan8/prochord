<?php

namespace App\Http\Controllers;

use App\Models\AddSong;
use App\Models\CategorySong;
use App\Models\IndexComment;
use App\Models\Performer;
use App\Models\Song;
use App\Models\SongComment;
use App\Models\Voting;
use App\Models\VotingIp;
use App\Models\VotingList;
use Illuminate\Http\Request;

class SongController extends MainController
{

    public function listCategory(CategorySong $categorySong, IndexComment $indexComment, Voting $voting, VotingList $votingList, VotingIp $votingIp, Request $request)
    {
        /**-------------------------------------------------------------
         * Add a comment to the category list
         * ----------------------------------------------------------------**/
        if ($request->has('body')) {
            $validator = IndexComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $indexComment = new indexComment();
                $indexComment->name = $request->get('name');
                $indexComment->email = $request->get('email');
                $indexComment->body = $request->get('body');
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
        $this->data['voting'] = $voting->getActive();// Витягую всі назви голосуванн
        $this->data['voting_list'] = $votingList->getActive();// Витягую весь список голосуванн
        $this->data['votingIp'] = $votingIp->getActive();// Витягую весь список голосуванн
        if ($request->has('voting_id')) {
            $browser_name = $_SERVER ['HTTP_USER_AGENT'];// Записую в зміну назву браузера для проведення статистики
            $voting_id_form = \Input::get('voting_value');// Записую значення з форми
            $getVotingId = $votingList->getVotingIpCheck($voting_id_form);//Витягую ід де воно дорівнює значення з форми
            $voting_id = $getVotingId->voting_id;//записую ід в зміну
            $people_ip = $_SERVER ['REMOTE_ADDR'];
            $getAddress = $votingIp->getActiveCheck($voting_id, $people_ip);// Витягую всі ip адреси та індифікатори голосування для перевірки
            if ($getAddress) {
                return \Response::json([
                    'success' => false,
                    'errors' => trans('translation.З_вашої_ip_уже_голосували')
                ]);
            } else {
                $votingIp->insertTable($voting_id, $people_ip, $browser_name);// передаю значення для запису таблиць
                $getVoting = $votingList->getVoting($voting_id_form);// передаю значення з форми в модель
                $addCount = $getVoting->count + 1;
                \DB::table('votingList')->WHERE('id', '=', $voting_id_form)->UPDATE(
                    ['count' => $addCount]
                );// перезаписую дані з додаванням 1
                /** --------------------------------------------------------------
                 *  Calculates the percentage of the vote
                 * -----------------------------------------------------------------*/
                $sumVotingList = $votingList->sumVotingList($voting_id);// витягуємо суму чисел з певним ід
                $voting->upSumVotingList($voting_id, $sumVotingList);//оновлюємо поле з сумою
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

    public function listSongs(Song $song, Request $request)
    {
        /**-------------------------------------------------------------
         * Sorting the list of songs
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['listSongs'] = $song->sortSong($sort, $sortBy);
        } else {
            $this->data['listSongs'] = $song->getActiveSongs();
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $song->most_popular();
        $this->data['last_add'] = $song->last_add();
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListSong', $this->data)->render());
        }
        return view('song.listSong', $this->data);
    }

    public function listSongsSort($item, Song $song, Request $request)
    {
        /**-------------------------------------------------------------
         * Sorting the list of songs
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['listSongs'] = $song->sortSong($sort, $sortBy);
        } else {
            $this->data['listSongs'] = $song->sortSongAlphabet($item);
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $song->most_popular_sort($item);
        $this->data['last_add'] = $song->last_add_sort($item);
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListSong', $this->data)->render());
        }
        return view('song.listSong', $this->data);
    }

    public function songsInCategory($title_eng, Song $song, CategorySong $categorySong, Request $request)
    {
        /**-------------------------------------------------------------
         * Count the number of hits categories and overwrites data in the database
         * ----------------------------------------------------------------**/
        $getCat = $categorySong->getId($title_eng);
        $idCat = $getCat->id;
        \DB::table('categorySong')->WHERE('id', '=', $idCat)->increment('count_views_cat');// рахуємо кулькість переглядів пісні
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
            $this->data['Song'] = $song->sortSongInCategory($idCat, $sort, $sortBy);
        } else {
            $this->data['Song'] = $song->getActive($idCat);
        }
        /**-------------------------------------------------------------
         * End of sorting the list of songs in categories
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.SongsInCategory', $this->data)->render());
        }
        return view('song.songsInCategory', $this->data);

    }

    public function cartSongInCategory($title_eng, $slug, Song $song, CategorySong $categorySong, SongComment $songComment, Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Add a comment to song
         * ----------------------------------------------------------------**/
        if ($request->has('songId')) {
            $validator = SongComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $songComment = new SongComment();
                $songComment->song_id = $request->get('songId');
                $songComment->name = $request->get('name');
                $songComment->email = $request->get('email');
                $songComment->body = $request->get('body');
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
        /**-------------------------------------------------------------
         * Like song
         * ----------------------------------------------------------------**/
        if (isset($_POST['Like'])) {
            $song_id = \Input::get('song_id'); // Записуєм id пісні
            $selectHeart = \DB::table('song')->SELECT('heart', 'address')->WHERE('id', '=', $song_id)->first();
            $increaseNumber = $selectHeart->heart + 1;
            $selectAddress = $selectHeart->address; // Записуєм в зміну ip яка знаходиться в базі даних
            $userAddress = $_SERVER ['REMOTE_ADDR']; // Записуєм ip користувача
            if ($selectAddress == $userAddress) { // Перевіряєм ip адресу щоб немож було голосувати 2 рази
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                \DB::table('song')->WHERE('id', '=', $song_id)->UPDATE(
                    ['heart' => $increaseNumber, 'address' => $userAddress]
                );
                $this->data['Like'] = trans('translation.Вам_сподобалось');
            }
        } elseif (isset($_POST['UnLike'])) {
            $song_id = \Input::get('song_id'); // Записуєм id пісні
            $selectHeart = \DB::table('song')->SELECT('heart', 'address')->WHERE('id', '=', $song_id)->first();
            $increaseNumber = $selectHeart->heart - 1;
            $selectAddress = $selectHeart->address; // Записуєм в зміну ip яка знаходиться в базі даних
            $userAddress = $_SERVER ['REMOTE_ADDR']; // Записуєм ip користувача
            if ($selectAddress == $userAddress) { // Перевіряєм ip адресу щоб немож було голосувати 2 рази
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                \DB::table('song')->WHERE('id', '=', $song_id)->UPDATE(
                    ['heart' => $increaseNumber, 'address' => $userAddress]
                );
                $this->data['UnLike'] = trans('translation.Вам_не_сподобалось');
            }
        }
        /** -------------------------------------------------------------
         * End like song
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Count the number of times songs and overwrites data in the database
         * ----------------------------------------------------------------**/
        $id_data = $song->oneSong($slug);
        $idSong = $id_data->id;//Ід Пісні
        \DB::table('song')->WHERE('id', '=', $idSong)->increment('count_views_song');// рахуємо кулькість переглядів пісні
        /**-------------------------------------------------------------
         * The end count number of times song and overwrites data in the database
         * ----------------------------------------------------------------**/
        $this->data['get'] = $categorySong->getId($title_eng);
        $this->data['cartSong'] = $song->oneSong($slug);
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $idCat = $this->data['get']->id;
        $this->data['most_popular'] = $song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['songComment'] = $songComment->getActive($idSong);
        $this->data['performer'] = $performer->getActive();

        return view('song.cartSong', $this->data);

    }

    public function cartSongs($slug, Song $song, CategorySong $categorySong, SongComment $songComment, Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Add narration to song
         * ----------------------------------------------------------------**/
        if ($request->has('songId')) {
            $validator = SongComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $songComment = new SongComment();
                $songComment->song_id = $request->get('songId');
                $songComment->name = $request->get('name');
                $songComment->email = $request->get('email');
                $songComment->body = $request->get('body');
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
        /**-------------------------------------------------------------
         * like song
         * ----------------------------------------------------------------**/
        if (isset($_POST['Like'])) {
            $song_id = \Input::get('song_id'); // Записуєм id пісні
            $selectHeart = \DB::table('song')->SELECT('heart', 'address')->WHERE('id', '=', $song_id)->first();
            $increaseNumber = $selectHeart->heart + 1;
            $selectAddress = $selectHeart->address; // Записуєм в зміну ip яка знаходиться в базі даних
            $userAddress = $_SERVER ['REMOTE_ADDR']; // Записуєм ip користувача
            if ($selectAddress == $userAddress) { // Перевіряєм ip адресу щоб немож було голосувати 2 рази
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                \DB::table('song')->WHERE('id', '=', $song_id)->UPDATE(
                    ['heart' => $increaseNumber, 'address' => $userAddress]
                );
                $this->data['Like'] = trans('translation.Вам_сподобалось');
            }
        } elseif (isset($_POST['UnLike'])) {
            $song_id = \Input::get('song_id'); // Записуєм id пісні
            $selectHeart = \DB::table('song')->SELECT('heart', 'address')->WHERE('id', '=', $song_id)->first();
            $increaseNumber = $selectHeart->heart - 1;
            $selectAddress = $selectHeart->address; // Записуєм в зміну ip яка знаходиться в базі даних
            $userAddress = $_SERVER ['REMOTE_ADDR']; // Записуєм ip користувача
            if ($selectAddress == $userAddress) { // Перевіряєм ip адресу щоб немож було голосувати 2 рази
                $this->data['error_like'] = trans('translation.З_вашої_ip_уже_голосували');
            } else {
                \DB::table('song')->WHERE('id', '=', $song_id)->UPDATE(
                    ['heart' => $increaseNumber, 'address' => $userAddress]
                );
                $this->data['UnLike'] = trans('translation.Вам_не_сподобалось');
            }
        }
        /** -------------------------------------------------------------
         * End like song
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves category properly that song
         * ---------------------------------------------------------------**/
        $getSong = $song->oneSong($slug);
        $idSong = $getSong->id;
        \DB::table('song')->WHERE('id', '=', $idSong)->increment('count_views_song');// рахуємо кулькість переглядів пісні
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
        $this->data['most_popular'] = $song->most_popular_songInCategory($idCat);
        $this->data['last_add'] = $song->last_add_songInCategory($idCat);
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular songs in the category
         * ----------------------------------------------------------------**/
        $this->data['cartSong'] = $song->oneSong($slug);
        $this->data['songComment'] = $songComment->getActive($idSong);
        $this->data['performer'] = $performer->getActive();


        return view('song.cartSong', $this->data);

    }

    public function addSong(AddSong $addSong, CategorySong $categorySong, Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Add narration to song
         * ----------------------------------------------------------------**/
        if ($request->has('tabulature')) {
            $validator = AddSong::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $AddSong = new AddSong();
                $AddSong->active = '0';
                $AddSong->title = $request->get('name');
                $AddSong->who_added = $request->get('you_name');
                $AddSong->slug = $request->get('name') . '_user';
                $AddSong->description = $request->get('description');
                $AddSong->performer_id = $request->get('performer');
                $AddSong->category_song_id = $request->get('category');
                $AddSong->tabulature = $request->get('tabulature');
                $AddSong->body = $request->get('body');
                $AddSong->save();

                return \Response::json([
                    'success' => trans('translation.Ваша_пісня_успішно_додана')
                ]);
            }
        }
        $this->data['category'] = $categorySong->getActive();
        $this->data['performer'] = $performer->getActive();
        return view('song.addSong', $this->data);

    }

    public function performers(Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Sort the list of performers
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['performer'] = $performer->sortPerformer($sort, $sortBy);
        } else {
            $this->data['performer'] = $performer->getActivePag();
        }
        /**-------------------------------------------------------------
         * End sort the list of performers
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular performers
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $performer->most_popular();
        $this->data['last_add'] = $performer->last_add();
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular performers
         * ----------------------------------------------------------------**/
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListPerformer', $this->data)->render());
        }
        return view('song.listPerformer', $this->data);
    }

    public function cartPerformers($title, Song $song, Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Count the number of times the artist and overwrites data in the database
         * ----------------------------------------------------------------**/
        $id_data = $performer->onePerformer($title);
        $idPerformer = $id_data->id;//Ід Виконавця
        \DB::table('performer')->WHERE('id', '=', $idPerformer)->increment('count_views_performer');// рахуємо кулькість переглядів пісні
        /**-------------------------------------------------------------
         * The end count views performer and overwrites data in the database
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves category properly that song
         * ----------------------------------------------------------------**/
        $this->data['getSong'] = $song->SongPerformer($idPerformer);
        /**-------------------------------------------------------------
         * End take out a category that song belongs
         * ----------------------------------------------------------------**/
        $this->data['cartPerformer'] = $performer->onePerformer($title);
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.CartPerformer', $this->data)->render());
        }
        return view('song.cartPerformer', $this->data);

    }


}