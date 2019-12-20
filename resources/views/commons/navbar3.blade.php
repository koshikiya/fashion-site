
    
    <nav class="navbar-expand navbar-light">
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <nav class="nav navbar-nav justify-content-center">
            {!! link_to_route('fashion.ranking','ランキング ',[],['class' => 'btn btn-sm ']) !!}
            @if (Auth::check()) 
                 {!! link_to_route('user.timeline','タイムライン ',[],['class' => 'btn btn-sm midashi-btn']) !!}
            @else
              {!! link_to_route('login', 'タイムライン', [], ['class' => 'btn btn-sm ']) !!}
            @endif
        </nav>
    </nav>
    