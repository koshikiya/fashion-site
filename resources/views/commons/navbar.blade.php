<header class="mb-4 sticky-top">
    
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:black;"> 
        <a class="navbar-brand" href="/">-Fashion-site-</a>
    
    <table class="search">
    <tr>   
        {!! Form::open(['route' => ['fashion.keyword'],'method' => 'get']) !!}
        <td>{!! Form::text('keyword',null,['placeholder' => 'アイテムを探す','class' => 'form-control']) !!}</td>
        <td>{!! Form::submit('検索',['class' => 'btn1 btn-sm']) !!}</td>
        {!! Form::close() !!}
    </tr>
    </table>  
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar" >
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">{!! link_to_route('fashions.create','投稿',[],['class' => 'nav-link']) !!}</li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">{!! link_to_route('fashion.index','トップページ') !!}</li>
                            <li class="dropdown-item">{!! link_to_route('fashion.ranking','ランキング ') !!}</li>
                            <li class="dropdown-item">{!! link_to_route('user.timeline','タイムライン') !!}</li>
                            <li class="dropdown-item">{!! link_to_route('users.show','マイページ',['id' => Auth::id()]) !!}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', '新規会員登録', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>