<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data)
    {
        $rules = [
          'username' => ['required', 'string', 'unique:player_accounts', 'min:4', 'max:20', 'regex:/^[A-Za-z0-9]+$/'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'password' => ['required', 'string', 'min:8'],
          'password_confirm' => ['required', 'string', 'min:8', 'same:password']
        ];

        return $this->validate($data, $rules);
    }

    function getUniquePilotName($pilotName)
    {
        $newPilotName = $pilotName .= rand(1000, 9999); //4 digit

        if (User::select('userId')->where('pilotName', $newPilotName)->exists())
          $newPilotName = $this->getUniquePilotName($pilotName);

        return $newPilotName;
    }

    function register(Request $request)
    {
        $this->validator($request);

        $pilotName = $request->username;

        if (User::select('userId')->where('pilotName', $pilotName)->exists()) {
          $pilotName = $this->getUniquePilotName($pilotName);
        }

        $info = [
          'lastIP' => $request->ip(),
          'registerIP' => $request->ip(),
          'registerDate' => date('d.m.Y H:i:s')
        ];

        $verification = [
          'verified' => false,
          'hash' => md5(microtime())
        ];

        $user = User::create([
            'username' => $request->username,
            'info' => json_encode($info),
            'pilotName' => $pilotName,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'verification' => json_encode($verification)
        ]);

        //DB::table('player_equipment')->insert(['userId' => $user->userId]);
        //DB::table('player_settings')->insert(['userId' => $user->userId]);

        return 'You successfully registered, please verify your e-mail address.';
    }
}
