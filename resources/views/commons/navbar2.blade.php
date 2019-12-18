
    <nav class="navbar-expand navbar-light">
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <nav class="nav navbar-nav justify-content-around">
              {!! link_to_route('fashion.category','WOMEN',['id' => 'WOMEN'],['class' => 'nav-link active']) !!}
              {!! link_to_route('fashion.category','MEN',['id' => 'MEN'],['class' => 'nav-link active']) !!}
              {!! link_to_route('fashion.category','KIDS',['id' => 'KIDS'],['class' => 'nav-link active']) !!}
        </nav>
    </nav>
