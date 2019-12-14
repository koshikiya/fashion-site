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
    
    public function timeline(){
        $user = \Auth::user();
        $fashions = $user->timeline()->orderBy('created_at', 'desc')->paginate(10);
        
        $data =[
            'fashions' => $fashions,
            'user' => $user];
        
        return view('users.timeline',$data);
    }
}
