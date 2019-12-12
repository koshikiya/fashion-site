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
        $this->validate($request, [
            'fashion_comment' => 'required|max:191',
            'tops' => 'required|max:191',
            'bottoms' => 'required|max:191',
            'shoes' => 'required|max:191'
        ]);
        
        //画像処理
        $name = $request->file('photo')->getClientOriginalName();
        $filename = $request->file('photo')->storeAs('public/image', $name);
        $request->photo = basename($filename);
        
        $request->user()->fashions()->create([
            'fashion_comment' => $request->fashion_comment,
            'tops' => $request->tops,
            'bottoms' => $request->bottoms,
            'shoes' => $request->shoes,
            'accessory' => $request->accessory,
            'photo' => $request->photo]);
            
            return redirect('/');
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
        return view('fashions.show',['fashion' => $fashion]);
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
        $this->validate($request, [
            'fashion_comment' => 'required|max:191',
            'tops' => 'required|max:191',
            'bottoms' => 'required|max:191',
            'shoes' => 'required|max:191'
        ]);
        //画像処理
        $fashion =Fashion::find($id);
        if($request->hasFile('photo')){
            \Storage::disk('local')->delete('public/image/'.$fashion->photo);
            $name = $request->file('photo')->getClientOriginalName();
            $filename = $request->file('photo')->storeAs('public/image', $name);
            $request->photo = basename($filename);
        }else{
            $request->photo = $fashion->photo;
        }
        $fashion->update([
            'fashion_comment' => $request->fashion_comment,
            'tops' => $request->tops,
            'bottoms' => $request->bottoms,
            'shoes' => $request->shoes,
            'accessory' => $request->accessory,
            'photo' => $request->photo]);
        
         return redirect('/'); 
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
        $fashion->delete();
        
        return redirect('/');
    }
}
