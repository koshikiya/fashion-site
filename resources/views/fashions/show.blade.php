@extends('layouts.app')

@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-sm-6">
                <td><img src="{{ $fashion->photo }}", class="img-fluid"></td>
            </div>
    
        <div class="col-sm-4 offset-1">
        <table class="table table-bordered">
            <tr>
                <td>トップス</td>
                <td>{{ $fashion->tops }}</td>
            </tr>
            <tr>
                <td>ボトムス</td>
                <td>{{ $fashion->bottoms }}</td>
            </tr>
            <tr>
                <td>シューズ</td>
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
            @if (Auth::check())    
                @if(Auth::id() === $fashion->user_id)
                <tr>
                    <td> 
                        {!! Form::open(['route' =>['fashions.edit', $fashion->id], 'method' => 'get']) !!}
                            {!! Form::submit('編集',['class' =>'btn btn-default btn-sm']) !!}
                        {!! Form::close() !!}
                    
                        {!! Form::open(['route' =>['fashions.destroy', $fashion->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除',['class' =>'btn btn-default btn-sm']) !!}
                        {!! Form::close() !!} 
                    </td>
                    <td>
                        <button class="btn btn-default btn-sm" type="button" onclick="history.back()">戻る</button>
                    </td>
                </tr>
                @else
                    @if (Auth::user()->favoring($fashion->id))
                <tr>
                    <td>
                        {!! Form::open(['route' => ['fashion.unfavorite', $fashion->id], 'method' => 'delete']) !!}
                            {!! Form::submit('お気に入りを外す', ['class' => "btn btn-default btn-sm"]) !!}
                        {!! Form::close() !!}
                        <button class="btn btn-default btn-sm" type="button" onclick="history.back()">戻る</button>
                    </td>
                </tr>
                    @else
                <tr>
                        <td>
                            {!! Form::open(['route' => ['fashion.favorite', $fashion->id]]) !!}
                                {!! Form::submit('お気にりする', ['class' => "btn btn-default btn-sm"]) !!}
                            {!! Form::close() !!}
                            <button class="btn btn-default btn-sm" type="button" onclick="history.back()">戻る</button>
                        </td>
                </tr>
                    @endif
                </td>
                @endif
            @else
            <td>
                {!! link_to_route('login', 'お気に入りする', [], ['class' => 'btn btn-sm']) !!}
            </td>
            @endif    
        
        </table>
        </div>
        </div>
    </div>
    
   
@endsection