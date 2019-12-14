@extends('layouts.app')

@section('content')

<table class="table table-bordered">
        
        <tr>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $user->id }}</td>
    
    @if (Auth::id() != $user->id)
    @if (Auth::user()->following($user->id))
        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('フォロー外す', ['class' => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('フォローする', ['class' => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
@endif   


@endsection