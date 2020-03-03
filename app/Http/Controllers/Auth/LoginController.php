<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'min:4', 'max:20', 'regex:/^[A-Za-z0-9_.]+$/'],
            'password' => ['required', 'string', 'min:8']
        ]);
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
      $credentials = [
        'username' => $request->username,
        'password' => $request->password,
      ];

      if (Auth::attempt($credentials)) {
        return 'ok';
      }

      return 'no';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
