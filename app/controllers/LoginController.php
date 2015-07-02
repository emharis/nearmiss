<?php

namespace App\Controllers;

class LoginController extends \BaseController {

    function getIndex() {
        if (\Auth::check()) {
            return \Redirect::to('home');
        } else {
            return \View::make('login');
        }
    }

    function postAuth() {
        $creds = array(
            'username' => \Input::get('username'),
            'password' => \Input::get('password')
        );

        try {
            \Illuminate\Support\Facades\Auth::attempt($creds);


            $user = \Toddish\Verify\Models\User::where('username', \Input::get('username'))->first();

            \Session::put('onuserid', $user->id);
            \Session::put('onusername', $user->username);
            \Session::put('islogin', true);

            return \Redirect::to('home');
        } catch (\Exception $e) {

            if (\Request::ajax()) {
                return 'loginerror';
            } else {
                Return \Redirect::to('login')->withErrors('loginerror');  //->with('login_errors',true);
            }
            return Response::error('404');
        }
    }

    function getLogout() {
        \Auth::logout();
        \Session::flush();
        return \Redirect::to('login');
    }

}
