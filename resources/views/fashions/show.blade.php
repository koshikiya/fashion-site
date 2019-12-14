@extends('layouts.app')

@section('content')


    <table class="table table-bordered">
        <tr>
            <td><img src="/storage/image/{{ $fashion->photo }}",width="200" height="200"></td>
        </tr>
        <tr>
            <td>{{ $fashion->fashion_comment }}</td>
        </tr>
        <tr>
            <td>トップス</td>
            <td>{{ $fashion->tops }}</td>
        </tr>
        <tr>
            <td>ボトムス</td>
            <td>{{ $fashion->bottoms }}</td>
        </tr>
        <tr>
            <td>靴</td>
            <td>{{ $fashion->shoes }}</td>
        </tr>
        <tr>
            <td>アクセサリー</td>
            <td>{{ $fashion->accessory }}</td>
        </tr>
        <tr>
            <td>ユーザー</td>
            <td>{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}</td>
        </tr>
    </table>
    
    @if(Auth::id() === $fashion->user_id)
        {!! Form::open(['route' =>['fashions.edit', $fashion->id], 'method' => 'get']) !!}
            {!! Form::submit('編集',['class' =>'btn btn-default btn-sm']) !!}
        {!! Form::close() !!} 
        {!! Form::open(['route' =>['fashions.destroy', $fashion->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除',['class' =>'btn btn-default btn-sm']) !!}
        {!! Form::close() !!} 
    @else
        @if (Auth::user()->favoring($fashion->id))
        {!! Form::open(['route' => ['fashion.unfavorite', $fashion->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入りを外す', ['class' => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
        @else
        {!! Form::open(['route' => ['fashion.favorite', $fashion->id]]) !!}
            {!! Form::submit('お気にりする', ['class' => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
        @endif
        

    @endif
    
@endsection