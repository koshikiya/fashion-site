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
        <li class="nav-item">{!! link_to_route('user.mypage','投稿'.count($user->fashions),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}" ]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followings','フォロー'.count($user->followings),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.followers','フォロワー'.count($user->followers),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}"]) !!}</li>
        <li class="nav-item">{!! link_to_route('user.favorites','お気に入り'.count($user->favorites),['id' => $user->id],['class'=> "nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}"]) !!}</li>
        
    </ul>
    
     @if (count($myfashions) > 0)
    <div class="box">
        @foreach ($myfashions as $myfashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $myfashion->id) }}"><img src="/storage/image/{{$myfashion->photo}}" width="230" height="300"></a></dd>
                    <div class="user">
                        <a href="{{ action('UsersController@show', $myfashion->user_id) }}"><img class="icon" src="/storage/image/{{ $myfashion->user->user_photo }}"></a>
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