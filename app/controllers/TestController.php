<?php

namespace App\Controllers;

class TestController extends \BaseController {

    function getIndex(){
        return \View::make('test');
    }
    
    function postDetil(){
        if(\Input::get('table') == 1){
            echo 1;
        }elseif(\Input::get('table') == 2){
            echo 2;
        }else{
            echo 3;
        }
    }

}
