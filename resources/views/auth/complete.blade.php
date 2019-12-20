@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h3>以下の情報で登録が完了しました。</h3>
    </div>

    <div class="col-sm">
        <table class="table table-bordered table1 ">

            <tr>
                <td>ID</td>
                <td>{{ Auth::user()->id }}</td>
            </tr>
            <tr>
                <td>ユーザー名</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <p class="mt-2">会員登録は{!! link_to_route('login', 'こちら') !!}</p>
        </table>>
    </div>
@endsection