@extends('layouts.app')

@section('content')

<table class="table table-bordered">
        
        <tr>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $user->id }}</td>
        


@endsection