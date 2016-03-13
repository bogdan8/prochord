<?php

namespace App\Http\Controllers;

use App\Models\Lessons;
use App\Models\LessonsComment;
use Illuminate\Http\Request;
use App\Http\Requests;

class LessonsController extends MainController
{
    public function index(Lessons $lessons)
    {
        $this->data['lessons'] = $lessons->getAll();
        return view('lessons.index', $this->data);
    }

    public function cart($id, Lessons $lessons, LessonsComment $comment, Request $request)
    {
        $getLessons = $lessons->getAll();
        $this->data['countLessons'] = count($getLessons);
        $this->data['lessons_cart'] = $lessons->cart($id);
        $id_cart = $this->data['lessons_cart']->id;
        $lessons->incrementLesson($id_cart);
        $this->data['lessons_comment'] = $comment->getActive($id_cart);
        return view('lessons.cart', $this->data);
    }

    public function add($id, Lessons $lessons, LessonsComment $comment, Request $request)
    {
        /**-------------------------------------------------------------
         * Add a comment to lessons
         * ----------------------------------------------------------------**/
        if ($request->has('lessonsId')) {
            $validator = LessonsComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $comment = new LessonsComment();
                $comment->lessons_id = $request->get('lessonsId');
                $comment->name = $request->get('name');
                $comment->email = $request->get('email');
                $comment->body = $request->get('body');
                $comment->save();

                return \Response::json([
                    'success' => trans('translation.Ваш_коментар_успішно_добавлений')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End add a comment to lessons
         * ----------------------------------------------------------------**/
        $this->data['lessons_cart'] = $lessons->cart($id);
        $id_cart = $this->data['lessons_cart']->id;
        $this->data['lessons_comment'] = $comment->getActive($id_cart);
        return view('lessons.cart', $this->data);
    }

}
