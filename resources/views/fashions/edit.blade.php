@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <td><img src="{{ $fashion->photo }}", class="img-fluid"></td>
            </div>
            <div class="col-sm">
                <div class="table2">
                    {!! Form::model($fashion, ['route' =>['fashions.update',$fashion->id],'enctype'=>'multipart/form-data','method'=>'put']) !!}
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
                        <tr>
                            <td>
                                <div class="file">
                                    {!! Form::label('file-test','画像アップロード',['id' =>'file-test-label']) !!}
                                    {!! Form::file('photo',['id' =>'file-test']) !!}
                                    {!! Form::text('file-test','null',['id' =>'file-test-name','disabled' => '']) !!}
                                </div>
                            </td>
                        </tr>
                        <div style="text-align: center;">      
                            {!! Form::submit('更新', ['class' => 'btn btn-sm']) !!}
                        </div>    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection