<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fashion;
use App\User;

class FashionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fashions =Fashion::orderBy('created_at', 'desc')->paginate(12);
        return view('fashions.index',['fashions'=>$fashions,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fashion = new Fashion;
        return view('fashions.create',['fashion' => $fashion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tops' => 'required|max:191',
            'bottoms' => 'required|max:191',
            'shoes' => 'required|max:191',
            'photo'=>'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        
        //画像処理
        $fashion = new Fashion;
        $file = $request->file('photo');
        $name = $request->file('photo')->getClientOriginalName();
        \Storage::disk('s3')->putFileas('/', $file,$name,'public');
        $request->photo = \Storage::disk('s3')->url($name);
        $fashion->photo_name =$name;
          
        \Auth::user()->fashions()->create([
            'tops' => $request->tops,
            'bottoms' => $request->bottoms,
            'shoes' => $request->shoes,
            'accessory' => $request->accessory,
            'photo' => $request->photo,
            'photo_name' => $fashion->photo_name]);
            
        return redirect('/')->with('message', '投稿が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fashion = Fashion::find($id);
        
        if(is_null($fashion)) {
            return view('errors.404');
        }
        $user = $fashion->user;
        $data =[
                'fashion'=> $fashion,
                'user'=> $user,
                ];
        return view('fashions.show',$data);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fashion = Fashion::find($id);
        if(\Auth::id() !== $fashion->user_id){
            return view('errors.403');
        }
        return view('fashions.edit',['fashion' => $fashion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tops' => 'required|max:191',
            'bottoms' => 'required|max:191',
            'shoes' => 'required|max:191',
            'photo'=>'image|mimes:jpeg,png,jpg|max:1024',
        ]);
        //画像処理
        $fashion =Fashion::find($id);
        if($request->hasFile('photo')){
            $disk =\Storage::disk('s3');
            $disk->delete($fashion->photo_name);
            $file = $request->file('photo');
            $name = $request->file('photo')->getClientOriginalName();
            \Storage::disk('s3')->putFileas('/', $file,$name,'public');
            $request->photo = \Storage::disk('s3')->url($name);
            $fashion->photo_name = $name;
        }else{
            $request->photo = $fashion->photo;
        }
        $fashion->update([
            'tops' => $request->tops,
            'bottoms' => $request->bottoms,
            'shoes' => $request->shoes,
            'accessory' => $request->accessory,
            'photo' => $request->photo,
            'photo_name' => $fashion->photo_name]);
        
        return redirect('/')->with('message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fashion = Fashion::find($id);
        if(\Auth::id() === $fashion->user_id){
            
        $disk =\Storage::disk('s3');
        $disk->delete($fashion->photo_name);
        $fashion->delete();
        return redirect('/')->with('message', '削除が完了しました。');
        }
        return view('errors.403');
    }
    
   public function ranking(){
      
        $fashions = Fashion::orderBy('favorite_count', 'desc')->paginate(12);
         
        return view('fashions.ranking',['fashions' => $fashions]);
   }
}
