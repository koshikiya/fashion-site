@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h3>ログイン</h3>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
               
                <div class="info2">{!! Form::submit('ログイン', ['class' => 'btn btn-md']) !!}</div>
                
            {!! Form::close() !!}

            {!! link_to_route('socialite.login','github',['id' =>'github'],['class' => 'btn btn-md']) !!}
            <p class="mt-2">会員登録をしてない方は{!! link_to_route('signup.get', 'こちら') !!}</p>
        </div>
    </div>
@endsection