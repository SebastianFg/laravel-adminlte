@if(Auth::User()->primer_logeo == null)
<hr>
@else
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand bg-dark navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <div class="collapse navbar-collapse top-right" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            &nbsp;
        </ul>
        
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
               {{--  <li><a href="{{ url('/register') }}">Register</a></li> --}}
            @else
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ Auth::user()->nombre }} </span>       
                    </a>
                    @csrf
                    <div class="col-md-12">

                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img alt="User Image"class="d-block img-fluid" src="../../img/avatar/{{ Auth::User()->imagen_perfil }}" >
                                <div class="col-md-12 col-md-offset-2">
                                    <p>
                                        <hr>
                                        {{ Auth::user()->nombre }}
                                        <br>
                                        @foreach(Auth::user()->roles as $item)
                                            <small>{{ $item->name}} |</small>
                                        @endforeach
                                    </p>
                                </div>
                            </li>
                            <li>
                                <hr>
                                <li class="user-footer" style="padding-right: 2px;">
                                    <div class="pull-right">
                                        <a class="btn btn btn-flat bg-dark" style="border-radius: 5px; " href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Salir </a>
                                    </div> 
                                    <div class="pull-left" style="padding-left: 2px;">
                   
                                        <a class="btn btn btn-flat bg-dark" data-toggle="modal" data-target="#modalEditarPerfil" style="border-radius: 5px; padding-left:2px;;" href="{{ route('editarPerfil') }}"><i class="fa fa-cogs"></i> Editar </a>
                                    </div>  
                                </li>     
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>

</nav>

@endif
<!-- /.navbar -->
<style type="text/css">
    .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
    }
</style>
