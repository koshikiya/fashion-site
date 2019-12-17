@extends('layouts.app')

@section('content')

    <ul class="nav nav-tabs nav-justified ">
        <li class="nav-item">{!! link_to_route('user.mypage','投稿'.count($user->fashions),['id' => Auth::id()],['class'=> "nav-link active"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => Auth::id()],['class'=> "nav-link"]) !!}</li>
    </ul>
    
     @if (count($myfashions) > 0)
    <div class="box">
        @foreach ($myfashions as $myfashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $myfashion->id) }}"><img src="/storage/image/{{$myfashion->photo}}" width="230" height="300"></a></dd>
                    <div class="user">
                        <p>{{ $myfashion->user->name }}</p>
                    </div>
                </dl>
        @endforeach
    </div>
    @else
        <p>投稿はありません</p>
    @endif








@endsection