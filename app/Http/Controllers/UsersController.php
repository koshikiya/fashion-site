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
        $user = User::find($id);
        return view('users.edit',['user' => $user]);
    }
    
    public function update(Request $request, $id){
        $this->validate($request, [
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
        //画像処理
        $user =User::find($id);
        if($request->hasFile('user_photo')){
            \Storage::disk('local')->delete('public/image/'.$user->user_photo);
            $name = $request->file('user_photo')->getClientOriginalName();
            $filename = $request->file('user_photo')->storeAs('public/image', $name);
            $request->user_photo = basename($filename);
        }else{
            $request->user_photo = $user->user_photo;
        }
        $user->update([
            'user_photo' => $request->user_photo,
            'name' => $request->name,
            'height' => $request->height,
            'gender' => $request->gender,
            'age' => $request->age,
        ]);
        
         return redirect('/'); 
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
    public function favorites($id){
        $user = User::find($id);
        $favorites = $user->favorites()->orderBy('created_at', 'desc')->paginate(12);
       
        $data =[
            'user' => $user,
            'favorites' => $favorites
            ];
        
        return view('users.favorites',$data);
    }
}
