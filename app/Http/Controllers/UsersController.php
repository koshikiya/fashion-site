<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }
    public function edit($id){
        $user = new User;
        return view('users.edit',['user' => $user]);
    }
    
    public function timeline(){
        $user = \Auth::user();
        $fashions = $user->timeline()->orderBy('created_at', 'desc')->paginate(10);
        
        $data =[
            'fashions' => $fashions,
            'user' => $user];
        
        return view('users.timeline',$data);
    }
    
    public function mypage($id){
    
        $user = User::find($id);
        $myfashions = $user->fashions;
        
        $data =[
            'user' => $user,
            'myfashions' => $myfashions
            ];
        return view('users.mypage',$data);
    }
    
    public function followings($id){
        $user = User::find($id);
        $followings = $user->followings;
        
        return view('users.followings',['followings' => $followings]);
    }
    public function followers($id){
        $user = User::find($id);
        $followers = $user->followers;
        
        return view('users.followings',['followers' => $followers]);
    }
    
}
