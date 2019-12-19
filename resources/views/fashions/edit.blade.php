@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-6">
        {!! Form::model($fashion, ['route' =>['fashions.update',$fashion->id],'enctype'=>'multipart/form-data','method'=>'put']) !!}
            
            <table class="form-group">
                <tr>
                    <td>
                        {!! Form::label('photo', '画像') !!}
                        {!! Form::file('photo', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('tops', 'トップス') !!}
                        {!! Form::text('tops', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('bottoms', 'ボトムス') !!}
                        {!! Form::text('bottoms', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('shoes', 'シューズ') !!}
                        {!! Form::text('shoes', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
                <tr>
                    <td>
                        {!! Form::label('accessory', 'アクセサリー') !!}
                        {!! Form::text('accessory', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            </table>
            
            {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            
        {!! Form::close() !!}
    </div>
</div>

@endsection