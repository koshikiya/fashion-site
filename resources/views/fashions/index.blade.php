@extends('layouts.app')

@section('content')
    @include('commons.navbar2')
    
    @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    
    @if (count($fashions) > 0)
        <div class="box">
            @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="{{$fashion->photo}}" width="230" height="330"></a></dd>
                    <div class="user">
                        <a href="{{ action('UsersController@show', $fashion->user->id) }}"><img class="icon" src="{{ $fashion->user->user_photo }}"></a>
                        <p class="favorite">{{ $fashion->user->name }}</p>
                        <p class='favorite'><i class="fas fa-heart"></i>{{ count($fashion->favorited) }}</p>
                    </div>
                </dl>
            @endforeach
        </div>
       {{ $fashions->links('pagination::bootstrap-4') }}
    @else
        <p>投稿はありません</p>
    @endif
@endsection