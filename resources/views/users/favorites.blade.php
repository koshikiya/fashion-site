@extends('layouts.app')

@section('content')

<div class="all"> 
    <div class="box6">
        <img class="icon2" src="{{ $user->user_photo }}" >
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
    </div>
    <div class="box2">
        <p class='name'>{{ $user->name }}</p></br>
        <p class="info">{{ $user->gender }}
        @if($user->height == !null)
            <span class="mgr-5">{{ $user->height.'cm' }}</span></p>
        @endif
    </div>
</div>
    <div class='nav1'>
        <ul class="nav nav-tabs nav-justified ">
            <li class="nav-item">{!! link_to_route('users.show','投稿'.count($user->fashions),['id' => $user->id],['class'=> "nav-link" ]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
            <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => $user->id],['class'=> "nav-link active"]) !!}</li>
        </ul>
        
        @if (count($favorites) > 0)
            <div class="box">
                @foreach ($favorites as $favorite)
                    <dl>
                        <dd><a href="{{ action('FashionsController@show', $favorite->id) }}"><img src="{{$favorite->photo}}" width="230" height="300"></a></dd>
                        <div class="user">
                            <a href="{{ action('UsersController@show', $favorite->id) }}"><img class="icon" src="{{ $favorite->user->user_photo }}"></a>
                            <p class="favorite">{{ $favorite->user->name }}</p> 
                            <p class='favorite'><i class="fas fa-heart"></i>{{ count($favorite->favorited) }}</p>
                        </div>
                    </dl>
                @endforeach
            </div>
        @else
            <p>お気に入りはありません</p>
        @endif
        {{ $favorites->links('pagination::bootstrap-4') }}
    </div>
@endsection