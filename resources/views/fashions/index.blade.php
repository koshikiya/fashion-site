@extends('layouts.app')

@section('content')



    @if (count($fashions) > 0)
    <div class="box">
        @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="/storage/image/{{$fashion->photo}}" width="230" height="300"></a></dd>
                    <dd>{{ $fashion->user->name }}</dd>
                </dl>
        @endforeach
    </div>
    @else
        <p>投稿はありません</p>
    @endif

@endsection