<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;

class FavoriteController extends Controller
{
    public function store(Request $request, $id){
        
        $fashion = Fashion::find($id); 
        
        $fashion->favorite_count += \Auth::user()->favorite($id);
        $fashion->save();
        
        return back()->with('message', 'お気に入りしました。');
    }
    public function destroy($id){
        
        $fashion = Fashion::find($id);
        
        $fashion->favorite_count -= \Auth::user()->unfavorite($id);
        $fashion->save();
        
        return back()->with('message', 'お気に入りを外しました。');
    }
}
