<?php

namespace App\Http\Controllers;

use App\Models\Alphabet;
use App\Models\Lessons;
use App\Models\Menu;
use App\Models\Performer;
use App\Models\Slider;
use App\Models\Song;
use Illuminate\Http\Request;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * @param Menu $menuModel
     * @param Slider $slider
     * @param Alphabet $alphabet
     * @param Song $song
     * @param Performer $performer
     * @param Lessons $lessons
     * @param Request $request
     */

    public function __construct(Menu $menuModel, Slider $slider, Alphabet $alphabet,Song $song,Performer $performer,Lessons $lessons,Request $request)
    {
        $this->performer = $performer; #Models performer
        $this->song = $song; #Models song
        $this->lessons = $lessons; #Models lessons
        $this->request = $request; #request

        $this->data['menu']['left'] = $menuModel->getLeftMenu();
        $this->data['menu']['right'] = $menuModel->getRightMenu();

        $this->data['slider'] = $slider->getActive();

        $this->data['alphabet'] = $alphabet->getActive();

        $this->data['countPerformer'] = count($performer->getActive());
        $this->data['countSong'] = count($song->getActive());
        $this->data['countLessons'] = count($lessons->getAll());

        $URL = $_SERVER['REQUEST_URI'];
        $this->data['url_lang'] = substr($URL, 1, 2);
    }

}