<?php

namespace App\Http\Controllers;


class PerformerController extends MainController
{

    public function performers()
    {
        /**-------------------------------------------------------------
         * Sort the list of performers
         * ----------------------------------------------------------------**/
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['performer'] = $this->performer->sortPerformer($sort, $sortBy);
        } else {
            $this->data['performer'] = $this->performer->getActivePag();
        }
        /**-------------------------------------------------------------
         * End sort the list of performers
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves the latest and most popular performers
         * ----------------------------------------------------------------**/
        $this->data['most_popular'] = $this->performer->most_popular();
        $this->data['last_add'] = $this->performer->last_add();
        /**-------------------------------------------------------------
         * End retrieves the newest and most popular performers
         * ----------------------------------------------------------------**/
        if ($this->request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.ListPerformer', $this->data)->render());
        }
        return view('song.listPerformer', $this->data);
    }

    public function cartPerformers($slug)
    {
        /**-------------------------------------------------------------
         * Count the number of times the artist and overwrites data in the database
         * ----------------------------------------------------------------**/
        $id_data = $this->performer->onePerformer($slug);
        $idPerformer = $id_data->id;//id performers
        $this->performer->increment_views_performer($idPerformer);// count the number of hits songs
        /**-------------------------------------------------------------
         * The end count views performer and overwrites data in the database
         * ----------------------------------------------------------------**/
        /**-------------------------------------------------------------
         * Retrieves category properly that song
         * ----------------------------------------------------------------**/
        $this->data['getSong'] = $this->song ->SongPerformer($idPerformer);
        /**-------------------------------------------------------------
         * End take out a category that song belongs
         * ----------------------------------------------------------------**/
        $this->data['cartPerformer'] = $this->performer->onePerformer($slug);
        if ($this->request->ajax()) {
            return \response()->json(view('song.ajaxPaginate.CartPerformer', $this->data)->render());
        }
        return view('song.cartPerformer', $this->data);

    }
}