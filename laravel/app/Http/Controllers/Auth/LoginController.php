<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/permissions';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $login_bg=array();
        $login_bg[0] = asset("assets/img/login-bg/login-bg-9.jpg");
        $login_bg[1] = asset("assets/img/login-bg/login-bg-11.jpg");
        $login_bg[2] = asset("assets/img/login-bg/login-bg-12.jpg");
        $login_bg[3] = asset("assets/img/login-bg/login-bg-13.jpg");
        $login_bg[4] = asset("assets/img/login-bg/login-bg-14.jpg");
        $login_bg[5] = asset("assets/img/login-bg/login-bg-15.jpg");
        $login_bg[6] = asset("assets/img/login-bg/login-bg-16.jpg");
        $login_bg[7] = asset("assets/img/login-bg/login-bg-17.jpg");
        $i=rand(0,7);
        return view('auth.login')->with("login_bg",$login_bg[$i]);
    }
}
