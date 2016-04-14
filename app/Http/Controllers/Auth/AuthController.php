<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
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
            'name' => 'required|max:255',
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
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['usertype'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function getLogin()
    {
        return view("auth.login");
    }
    public function getRegister()
    {
        return view("auth.register");
    }
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to("/");
    }
    public function postLogin()
    {
        $data = Input::all();
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        }
        else{
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            if (Auth::attempt($userdata)) {
                $user = Auth::user();
            }
            else{
                return "failed";
            }
        }
        Session::put('key', 'value');
        return Redirect::to('/');
    }
    public function postRegister()
    {
        $data = Input::all();
        $validat = $this->validator($data);

        if($validat->fails())
        {
            return "error";
        }
        else
        {
            if($data['usertype'] == 1 || $data['usertype'] == 2) {
                $user = $this->create($data);
                $user->save();
                return "success";
            }
            else return "error user type";
        }
    }
}
