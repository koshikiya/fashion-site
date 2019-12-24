@extends('layouts.app')

@section('content')
    
    @if($user->user_photo !=null)
        <img class="icon2" src="{{ $user->user_photo }}">
    @endif
    <div class="box2">
        <p class='name'>{{ $user->name }}</p></br>
        <p class="info">{{ $user->gender }}
        @if($user->height == !null)
            <span class="mgr-10">{{ $user->height.'cm' }}</span></p>
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
        <li class="nav-item">{!! link_to_route('users.show','投稿'.count($user->fashions),['id' => $user->id],['class'=> "nav-link " ]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => $user->id],['class'=> "nav-link active"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => $user->id],['class'=> "nav-link"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => $user->id],['class'=> "nav-link "]) !!}</li>
    </ul>
    
    @if (count($followings) > 0)
    <div class="box3">
        @foreach ($followings as $following)
                <dl>
                    <div class="user1">
                        <a href="{{ action('UsersController@show', $following->id) }}"><img class="icon" src="{{ $following->user_photo }}"></a>
                        <p>{{ $following->name }}</p>
                        <dd>
                    @if (Auth::check())
                        @if (Auth::id() != $following->id)
                            @if (Auth::user()->following($following->id))
                                {!! Form::open(['route' => ['user.unfollow', $following->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('フォロー外す', ['class' => "btn1 btn-default btn-sm"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['user.follow', $following->id]]) !!}
                                    {!! Form::submit('フォローする', ['class' => 'btn1 btn-default btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
                    @else
                        {!! Form::open(['route' => 'login', 'method' => 'get']) !!}
                            {!! Form::submit('フォローする', ['class' => "btn btn-default btn-sm"]) !!}
                        {!! Form::close() !!}
                    @endif
                       </dd>
                    </div>
                </dl>
        @endforeach
    </div>
    @else
        <p>フォローしていません</p>
    @endif
    </div>
@endsection