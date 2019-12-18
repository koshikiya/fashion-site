@extends('layouts.app')

@section('content')
    @include('commons.navbar2')
    @if (count($fashions) > 0)
    <div class="box">
        @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="/storage/image/{{$fashion->photo}}" width="230" height="330"></a></dd>
                    <div class="user">
                        <a href="{{ action('UsersController@show', $fashion->user->id) }}"><img class="icon" src="/storage/image/{{ $fashion->user->user_photo }}"></a>
                        <p>{{ $fashion->user->name }}</p>
                        <p class='favorite'><i class="fas fa-heart"></i>{{ count($fashion->favorited) }}</p>
                    </div>
                </dl>
        @endforeach
    </div>
    @else
        <p>投稿はありません</p>
    @endif

@endsection