<?php

namespace App\Http\Controllers;

use App\Models\Alphabet;
use App\Models\Menu;
use App\Models\Slider;

class MainController extends Controller
{
    public function __construct(Menu $menuModel, Slider $slider, Alphabet $alphabet)
    {

        $this->data['menu']['left'] = $menuModel->getLeftMenu();
        $this->data['menu']['right'] = $menuModel->getRightMenu();

        $this->data['slider'] = $slider->getActive();

        $this->data['alphabet'] = $alphabet->getActive();

        $URL = $_SERVER['REQUEST_URI'];
        $this->data['url_lang'] = substr($URL, 1, 2);
    }

}