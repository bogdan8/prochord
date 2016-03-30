<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\ChordSong;
use App\Models\Search;

class IndexController extends MainController
{

    public function chords(ChordSong $chordSong)
    {
        $this->data['chordSong'] = $chordSong->getActive();

        return view('pages.chordSong', $this->data);
    }

    public function search(Search $search)
    {
        if (isset($_POST['sort'])) {
            $input = \Input::all();
            $sort = $input['sort'];
            $sortBy = $input['sortBy'];
            $this->data['search'] = $this->song->sortSong($sort, $sortBy);
        } else {
            $this->data['search'] = $this->song->getActiveSongs();
        }
        $this->data['most_popular'] = $this->song->most_popular();
        $this->data['last_add'] = $this->song->last_add();
        $this->data['search'] = $search->getActive();

        return view('pages.search', $this->data);
    }

    public function feedback(Feedback $feedback)
    {
        $this->data['feedback'] = $feedback->getActive();

        if ($this->request->has('name')) {
            if($this->request->get('name') == 'Admin'
                || $this->request->get('name') == 'admin'
                || $this->request->get('name') == 'Administrator'
                || $this->request->get('name') == 'administrator'){//check that no name admin or administrator
                return view('pages.feedback', $this->data)->with('errors_name',trans('translation.Ви_ввели_невірне_імя'));
            }
            $validator = Feedback::validate(\Input::all());//validation
            if ($validator->fails()) {
                return view('pages.feedback', $this->data)->with('errors',$validator->errors());
            } else {
                $feedback = new Feedback();
                $feedback->role = 0;
                $feedback->name = $this->request->get('name');
                $feedback->email = $this->request->get('email');
                $feedback->body = $this->request->get('body');
                $feedback->save();

                return view('pages.feedback', $this->data)->with('success',trans('translation.Ваш_коментар_успішно_добавлений'));
            }
        }else{
            return view('pages.feedback', $this->data);
        }

    }
}