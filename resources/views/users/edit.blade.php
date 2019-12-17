@extends('layouts.app')

@section('content')

    <div class="row">
            <div class="col-6">
                {!! Form::model($user, ['route' => ['users.update',$user->id],'enctype'=>'multipart/form-data','method' => 'put']) !!}
            
                    <table class="form-group">
                        <tr>
                            <td>
                            {!! Form::label('user_photo', 'アイコン') !!}
                            {!! Form::file('user_photo', null, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {!! Form::label('name', 'ニックネーム') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {!! Form::label('height', '身長') !!}
                            {!! Form::selectRange('height', 140, 190, null, ['placeholder' => '選択してください','class' => 'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {!! Form::label('gender', '性別') !!}
                            {!! Form::select('gender', ['WOMEN' => 'WOMEN','MEN' =>'MEN','KIDS' =>'KIDS'],null, ['placeholder' => '選択してください','class' => 'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {!! Form::label('age', '年齢') !!}
                            {!! Form::selectRange('age', 0, 100, null, ['placeholder' => '選択してください','class' => 'form-control']) !!}
                            </td>
                        </tr>
                    </table>
            
                    {!! Form::submit('更新', ['class' => 'btn btn-default btn-sm']) !!}
            
                {!! Form::close() !!}
            </div>
    </div>

@endsection