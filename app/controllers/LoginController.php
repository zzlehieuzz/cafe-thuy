<?php

class LoginController extends BaseController {

    public function __construct()
    {
//        $this->beforeFilter('guest', ['only' => ['index']]);
//        $this->beforeFilter('auth', ['only' => ['getLogout']]);
    }

    public function index()
    {
        return View::make('login');
    }

    public function login()
    {
        if (Request::isMethod('post')) {
            $params  = Input::all();
            $vParams = User::validate($params);

            if ($vParams) {
                $user = User::where('username', $params['username'])
                    ->where('password', md5($params['password']))->first();

                if($user) {
                    Auth::login($user);
                } else return Redirect::route('login-index')
                    ->withErrors('Your username/password combination was incorrect.')
                    ->withInput();
            }
            $userErrors = User::getValidationMessages();

            if (Auth::getUser()) {
                return Redirect::to('dash-board/index')->withSuccess('Login successfully.');
            }

            if($userErrors) {
                return Redirect::route('login-index')->withErrors($userErrors)->withInput();
            }
        }

        return Redirect::route('login-index');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('login-index');
    }
}
