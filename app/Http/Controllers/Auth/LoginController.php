<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
      $user = Socialite::driver($provider)->user();
      $regUser = User::where('email', $user->getEmail())->first();
      //validate user
      if(!$regUser) {
        $regUser = new User;
        $regUser->name = $user->getName();
        $regUser->email = $user->getEmail();
        $regUser->password = str_random(40);
        $regUser->email_verified_at = date('Y-m-d H:i:s');
        $regUser->avatar = $user->getAvatar();
        $regUser->save();
      } else {
        $regUser->touch();
      }
      $regUser->touch();
      Auth::login($regUser, true);
      return redirect()->route('home');
    }
}
