@extends('layouts.app')

@section('content')
    
    @if($user->user_photo !=null)
    <img class="icon2" src="/storage/image/{{ $user->user_photo }}">
    @endif
    <div class="box2">
    <p class='name'>{{ $user->name }}</p></br>
    <p class="info">{{ $user->height }}/{{ $user->gender }}/{{ $user->age }}</p>
    </div>
    {!! Form::open(['route' =>['users.edit',$user->id], 'method' => 'get']) !!}
        {!! Form::submit('プロフィール変更',['class' => "btn btn-default btn-md"]) !!}
    {!! Form::close() !!}
    <div class='nav1'>
    <ul class="nav nav-tabs nav-justified ">
        <li class="nav-item">{!! link_to_route('user.mypage','投稿'.count($user->fashions),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}"]) !!}</li>
    </ul>
    
    @if (count($followings) > 0)
    <div class="box3">
        @foreach ($followings as $following)
                <dl>
                    <div class="user1">
                        <a href="{{ action('UsersController@show', $following->id) }}"><img class="icon" src="/storage/image/{{ $following->user_photo }}"></a>
                        <p>{{ $following->name }}</p>
                        <dd>
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