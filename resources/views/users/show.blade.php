@extends('layouts.app')

@section('content')

@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif
    
    @if($user->user_photo !=null)
        <img class="icon2" src="{{ $user->user_photo }}">
    @endif
    <div class="box2">
        <p class='name'>{{ $user->name }}</p></br>
        <p class="info">{{ $user->gender }}
        @if($user->height == !null)
            <span class="mgr-5">{{ $user->height.'cm' }}</span></p>
        @endif
    </div>
    @if (Auth::check()) 
        @if( Auth::id() == $user->id)
            {!! Form::open(['route' =>['users.edit',$user->id], 'method' => 'get']) !!}
                {!! Form::submit('プロフィール変更',['class' => "btn btn-default btn-md"]) !!}
            {!! Form::close() !!}
        @else
            @if (Auth::id() != $user->id)
                @if (Auth::user()->following($user->id))
                    {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
                        {!! Form::submit('フォロー外す', ['class' => "btn btn-default btn-md"]) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
                        {!! Form::submit('フォローする', ['class' => 'btn btn-default btn-md']) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        @endif
    @else
        {!! Form::open(['route' => 'login', 'method' => 'get']) !!}
            {!! Form::submit('フォローする', ['class' => "btn btn-default btn-md"]) !!}
        {!! Form::close() !!}
    @endif
    <div class='nav1'>
        <ul class="nav nav-tabs nav-justified ">
            <li class="nav-item">{!! link_to_route('users.show','投稿'.count($user->fashions),['id' => $user->id],['class'=> "nav-link active" ]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
        </ul>
    
        @if (count($myfashions) > 0)
            <div class="box">
                @foreach ($myfashions as $myfashion)
                    <dl>
                        <dd><a href="{{ action('FashionsController@show', $myfashion->id) }}"><img src="{{$myfashion->photo}}" width="230" height="300"></a></dd>
                        <div class="user">
                            <img class="icon" src="{{ $myfashion->user->user_photo }}">
                            <p>{{ $myfashion->user->name }}</p>
                            <p class='favorite'><i class="fas fa-heart"></i>{{ count($myfashion->favorited) }}</p>
                        </div>
                    </dl>
                @endforeach
            </div>
        @else
            <p>投稿はありません</p>
        @endif
    </div>
@endsection