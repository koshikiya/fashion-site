<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;

class SearchController extends Controller
{
    public function keyword(Request $request){
        
        $keyword = $request->input('keyword');
        
        if(!empty($keyword)){
            $fashions = Fashion::where('tops', 'like', '%'.$keyword.'%')
            ->orWhere('bottoms', 'like', '%'.$keyword.'%')->orWhere('shoes', 'like', '%'.$keyword.'%')
            ->orWhere('accessory', 'like', '%'.$keyword.'%')->paginate(12);
        }else{
            $fashions = Fashion::orderBy('created_at', 'desc')->paginate(12);
        }
       
        return view('fashions.keyword',['fashions' => $fashions]);
    }
}
