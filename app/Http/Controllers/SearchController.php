<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;
use App\User;

class SearchController extends Controller
{
    public function keyword(Request $request){
        
        $keyword = $request->keyword;
        
        if(!empty($keyword)){
            $fashions = Fashion::where('tops', 'like', '%'.$keyword.'%')
            ->orWhere('bottoms', 'like', '%'.$keyword.'%')->orWhere('shoes', 'like', '%'.$keyword.'%')
            ->orWhere('accessory', 'like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->paginate(12);
        }else{
            $fashions = Fashion::orderBy('created_at', 'desc')->paginate(12);
        }
       
        return view('fashions.keyword',['fashions' => $fashions]);
    }
     public function category($id){
         
        $users = User::where('gender',$id)->pluck('id')->toArray();
        $fashions =Fashion::whereIn('user_id',$users)->orderBy('created_at', 'desc')->paginate(12);
        
        return view('fashions.category',['fashions' => $fashions]);
    }
}
