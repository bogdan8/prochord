<?php

namespace App\Http\Controllers;

use App\Models\Performer;
use App\Models\Song;
use Illuminate\Http\Request;

class PerformerController extends MainController
{

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

    public function cartPerformers($slug, Song $song, Performer $performer, Request $request)
    {
        /**-------------------------------------------------------------
         * Count the number of times the artist and overwrites data in the database
         * ----------------------------------------------------------------**/
        $id_data = $performer->onePerformer($slug);
        $idPerformer = $id_data->id;//id performers
        $performer->increment_views_performer($idPerformer);// count the number of hits songs
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
        $this->data['cartPerformer'] = $performer->onePerformer($slug);
        if ($request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.CartPerformer', $this->data)->render());
        }
        return view('song.cartPerformer', $this->data);

    }
}