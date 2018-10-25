<?php

namespace App\Http\Controllers\Auth;

use App\Http\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function  showRegistrationForm()
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
        return view('auth.register')->with("register_bg",$login_bg[$i]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Http\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //'password' =>$data['password'],
        ]);
    }
}
