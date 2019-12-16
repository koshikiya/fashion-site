@extends('layouts.app')

@section('content')



    @if (count($fashions) > 0)
    <div class="box">
        @foreach ($fashions as $fashion)
                <dl>
                    <dd><a href="{{ action('FashionsController@show', $fashion->id) }}"><img src="/storage/image/{{$fashion->photo}}" width="230" height="300"></a></dd>
                    <dd>
                        {{ $fashion->user->name }}
                        @if (Auth::id() != $fashion->user->id)
                            @if (Auth::user()->following($fashion->user->id))
                                {!! Form::open(['route' => ['user.unfollow', $fashion->user->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('フォロー外す', ['class' => "btn btn-default btn-sm"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['user.follow', $fashion->user->id]]) !!}
                                    {!! Form::submit('フォローする', ['class' => "btn btn-default btn-sm"]) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif   
                    </dd>
                    
                </dl>
        @endforeach
    </div>
    @else
        <p>投稿はありません</p>
    @endif

@endsection