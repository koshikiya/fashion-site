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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToProvider($provider) {
      
    return Socialite::driver($provider)->redirect();
  }

  public function handleProviderCallback($provider) {
    
    try{
      $user = Socialite::with($provider)->user();
  
    }catch (\Exception $e) {
      return view('errors.404'); 
    }
  
    $authUser = User::where('email',$user->email)->first();
    
    //DBにデータがあればログインなければ登録
    if($authUser){
      Auth::login($authUser); 
      return redirect('/')->with('message', 'ログイン成功しました');;
    }else{
      $authUser= User::create([
                  'name' => $user->nickname,
                  'email' => $user->email,
                  'provider' => $provider,
                ]);
      return view('auth.complete',['authUser' => $authUser]);  
  
    }
  }
}
