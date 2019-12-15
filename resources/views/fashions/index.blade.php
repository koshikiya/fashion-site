@extends('layouts.app')

@section('content')



    @if (count($fashions) > 0)
        <table class="table table-striped">

            @foreach ($fashions as $fashion)
                <dl>
                    <dd><img src="/storage/image/{{$fashion->photo}}" width="200" height="200"></dd>
                    <dd>{{ $fashion->fashion_comment }}</dd>
                    <dd>{{ $fashion->favorite_count }}</dd>
                    {!! Form::open(['route' => ['fashions.show',$fashion->id],'method'=>'get']) !!}
                        {!! Form::submit('詳細',['class' => 'btn btn-default btn-sm' ]) !!}
                    {!! Form::close() !!}
                </dl>
                
            @endforeach
            
        </table>
        
    @else
        <p>投稿はありません</p>
    @endif

@endsection