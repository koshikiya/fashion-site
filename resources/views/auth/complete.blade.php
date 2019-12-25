@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h3>以下の情報で登録が完了しました。</h3>
    </div>

    <div class="col-sm">
        <table class="table table-bordered table1 ">
            <tr>
                <td>ユーザー名</td>
                <td>{{ $authUser->name }}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{ $authUser->email }}</td>
            </tr>
        </table>
            <p class="mt-2">ログインは{!! link_to_route('login', 'こちら') !!}</p>
    </div>
@endsection