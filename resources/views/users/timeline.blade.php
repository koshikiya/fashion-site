

@extends('layouts.app')

@section('content')

    @if (count($fashions) > 0)
    <div class="box">
        @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="/storage/image/{{$fashion->photo}}" width="230" height="300"></a></dd>
                    <div class="user">
                        <a href="{{ action('UsersController@show', $fashion->user->id) }}"><img class="icon" src="/storage/image/{{ $fashion->photo }}",width="40" height="49"></a>
                        <p>{{ $fashion->user->name }}</p>
                    </div>
                    
                </dl>
        @endforeach
    </div>
    @else
        <p>投稿はありません</p>
    @endif
@endsection