@extends('layouts.app')

@section('content')

        <div class="table">
                {!! Form::model($user, ['route' => ['users.update',$user->id],'enctype'=>'multipart/form-data','method' => 'put']) !!}
                        <tr>
                            <td>
                            {!! Form::label('name', 'ニックネーム') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
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
                            {!! Form::label('height', '身長') !!}
                            {!! Form::selectRange('height', 140, 190, null, ['placeholder' => '選択してください','class' => 'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                            {!! Form::label('user_photo', 'アイコン') !!}
                            {!! Form::file('user_photo', null, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    <div style="text-align: center;">   
                         {!! Form::submit('更新', ['class' => 'btn btn-sm']) !!}
                    </div>   
                    </table>
            
                {!! Form::close() !!}
        </div>

@endsection