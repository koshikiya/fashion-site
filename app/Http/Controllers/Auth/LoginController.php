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
      return redirect('login'); // エラーならログイントップへ転送
    }
  
    $authUser = User::where('provider_id',$user->id)->first();
    
    if($authUser){
      Auth::login($authUser,true); // ログイン
      return redirect('/');
    }else{
      $loginUser = new User;
      $data =[
        'provider' => $provider,
        'user' => $user,
        'loginUser' => $loginUser];
        
      return view('auth.createUser',$data);  
    }
  }
  
  public function authUserCreate(Request $request){
    
    User::create([
      'name' => $request->nickname,
      'email' => $request->email,
      'provider' =>$request->provider,
      'provider_id' => $request->id
       ]);
      return redirect('login');
    }
  
}
