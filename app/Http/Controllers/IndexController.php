<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Song;
use App\Models\ChordSong;
use App\Models\Search;
use Illuminate\Http\Request;

class IndexController extends MainController
{

    public function chords(ChordSong $chordSong)
    {
        $this->data['chordSong'] = $chordSong->getActive();

        return view('pages.chordSong', $this->data);
    }

    public function search(Search $search, Song $song)
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

    public function feedback(Feedback $feedback,Request $request)
    {
        $this->data['feedback'] = $feedback->getActive();

        if ($request->has('name')) {
            if($request->get('name') == 'Admin'
                || $request->get('name') == 'admin'
                || $request->get('name') == 'Administrator'
                || $request->get('name') == 'administrator'){//check that no name admin or administrator
                return view('pages.feedback', $this->data)->with('errors_name',trans('translation.Ви_ввели_невірне_імя'));
            }
            $validator = Feedback::validate(\Input::all());//validation
            if ($validator->fails()) {
                return view('pages.feedback', $this->data)->with('errors',$validator->errors());
            } else {
                $feedback = new Feedback();
                $feedback->role = 0;
                $feedback->name = $request->get('name');
                $feedback->email = $request->get('email');
                $feedback->body = $request->get('body');
                $feedback->save();

                return view('pages.feedback', $this->data)->with('success',trans('translation.Ваш_коментар_успішно_добавлений'));
            }
        }else{
            return view('pages.feedback', $this->data);
        }

    }
}