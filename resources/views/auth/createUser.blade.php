@extends('layouts.app')

@section('content')

    <div class="table"><p>以下登録でよろしいですか？</p>
        <dl>
            {!! Form::model($loginUser, ['route' => 'user.create']) !!}
            
                <tr>
                    <td>
                        {!! Form::label('name', '名前') !!}
                        {!! Form::file('name', $user->nickname, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('provider', 'プロバイダー') !!}
                        {!! Form::text('provider',$provider, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('provider_id', 'プロバイダーID') !!}
                        {!! Form::text('provider_id', $user->id, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            
                {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
            
            {!! Form::close() !!}
            
        </dl>
    </div>

@endsection