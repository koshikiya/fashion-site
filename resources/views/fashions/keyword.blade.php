@extends('layouts.app')

@section('content')
    @include('commons.navbar3')
    
    <div class="box">
        @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="{{$fashion->photo}}" width="230" height="330"></a></dd>
                    <div class="user">
                        <a href="{{ action('UsersController@show', $fashion->user->id) }}"><img class="icon" src="{{ $fashion->user->user_photo }}"></a>
                        <p>{{ $fashion->user->name }}</p>
                        <p class='favorite'><i class="fas fa-heart"></i>{{ count($fashion->favorited) }}</p>
                    </div>
                </dl>
        @endforeach
    </div>
      {{ $fashions->appends(request()->input())->links('pagination::bootstrap-4') }}
@endsection