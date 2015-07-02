<?php

namespace App\Controllers;

class HomeController extends \BaseController {

    function getIndex() {
        return \View::make('home');
    }

}
