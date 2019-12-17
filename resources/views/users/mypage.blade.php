@extends('layouts.app')

@section('content')

    <ul class="nav nav-tabs">
        <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => Auth::id()],['class'=> "nav-link active"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.myfashions','コーディネート'.count($user->fashions),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
    </ul>








@endsection