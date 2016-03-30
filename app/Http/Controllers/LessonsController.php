<?php

namespace App\Http\Controllers;

use App\Models\LessonsComment;

class LessonsController extends MainController
{
    public function index()
    {
        $this->data['lessons'] = $this->lessons->getAll();
        return view('lessons.index', $this->data);
    }

    public function cart($id, LessonsComment $comment)
    {
        $getLessons = $this->lessons->getAll();
        $this->data['countLessons'] = count($getLessons);
        $this->data['lessons_cart'] = $this->lessons->cart($id);
        $id_cart = $this->data['lessons_cart']->id;
        $this->lessons->incrementLesson($id_cart);
        $this->data['lessons_comment'] = $comment->getActive($id_cart);
        return view('lessons.cart', $this->data);
    }

    public function add($id, LessonsComment $comment)
    {
        /**-------------------------------------------------------------
         * Add a comment to lessons
         * ----------------------------------------------------------------**/
        if ($this->request->has('lessonsId')) {
            $validator = LessonsComment::validate(\Input::all());
            if ($validator->fails()) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            } else {
                $comment = new LessonsComment();
                $comment->lessons_id = $this->request->get('lessonsId');
                $comment->name = $this->request->get('name');
                $comment->email = $this->request->get('email');
                $comment->body = $this->request->get('body');
                $comment->save();

                return \Response::json([
                    'success' => trans('translation.Ваш_коментар_успішно_добавлений')
                ]);
            }
        }
        /**-------------------------------------------------------------
         * End add a comment to lessons
         * ----------------------------------------------------------------**/
        $this->data['lessons_cart'] = $this->lessons->cart($id);
        $id_cart = $this->data['lessons_cart']->id;
        $this->data['lessons_comment'] = $comment->getActive($id_cart);
        return view('lessons.cart', $this->data);
    }

}
