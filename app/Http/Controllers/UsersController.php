<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $myfashions = $user->fashions;
        
        $data =[
            'user' => $user,
            'myfashions' => $myfashions
            ];

        return view('users.show',$data);
            
    }
 
    public function edit($id){
        
        $user = User::find($id);
        if(\Auth::id() == $user->id){
        return view('users.edit',['user' => $user]);
        }
        return redirect('/');
    }
    
    public function update(Request $request, $id){
        $this->validate($request, [
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
        //画像処理
        $user =User::find($id);
        if($request->hasFile('user_photo')){
            $disk =\Storage::disk('s3');
            $disk->delete($user->user_photo_name);
            $file = $request->file('user_photo');
            $name = $request->file('user_photo')->getClientOriginalName();
            $path =\Storage::disk('s3')->putFileas('/', $file,$name,'public');
            $request->user_photo = \Storage::disk('s3')->url($path);
            $user->user_photo_name = $name;
        }else{
            $request->user_photo = $user->user_photo;
        }
        $user->update([
            'user_photo' => $request->user_photo,
            'name' => $request->name,
            'height' => $request->height,
            'gender' => $request->gender,
            'age' => $request->age,
            'user_photo_name' => $user->user_photo_name
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
    
    
    public function followings($id){
        $user = User::find($id);
        $followings = $user->followings;
        
        $data =[
            'user' => $user,
            'followings' => $followings
            ];
        
        return view('users.followings',$data);
    }
    public function followers($id){
        $user = User::find($id);
        $followers = $user->followers;
        $data =[
            'user' => $user,
            'followers' => $followers
            ];
        
        return view('users.followers',$data);
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
