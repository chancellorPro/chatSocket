<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Validator;use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|alpha_dash|max:255|min:3|unique:users|',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function authenticate(array $data)
    {

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]))
        {
            // Аутентификация прошла успешно
            return redirect()->intended('dashboard');
        } else User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'color' => sprintf('%02X%02X%02X', rand(0,120), rand(0,120), rand(0,120)),
            'activated' => 1
        ]);
    }
/*
    public function getRegister()
    {
        return view('chat.login');
    }
 */

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'color' => sprintf('%02X%02X%02X', rand(0,120), rand(0,120), rand(0,120)),
            'activated' => 1
        ]);
    }
}
