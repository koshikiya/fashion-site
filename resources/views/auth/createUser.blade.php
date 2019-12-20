@extends('layouts.app')

@section('content')

    <div class="table"><p>以下登録でよろしいですか？</p>
        <dl>
            {!! Form::model($loginUser, ['route' => 'user.create']) !!}
            
                <tr>
                    <td>
                        {!! Form::label('name', '名前') !!}
                        {!! Form::text('name',"{{ $user->nickname }}", ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::text('email',null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('provider', 'プロバイダー') !!}
                        {!! Form::text('provider',null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('provider_id', 'プロバイダーID') !!}
                        {!! Form::text('provider_id',null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            
                {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
            
            {!! Form::close() !!}
            
        </dl>
    </div>

@endsection