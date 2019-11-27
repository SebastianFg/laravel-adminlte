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
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else

                <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> -->
                    <!-- <img src="{{asset("/dist/img/user2-160x160.jpg")}}" class="user-image" alt="User Image"> -->
              <span class="hidden-xs">{{ Auth::user()->nombre }} </span>       
                </a>
                @csrf
                    <div class="col-md-12">

                        <ul class="dropdown-menu">
                        <li class="user-header">
                                <img src="{{asset("/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">

                            <p>
                                <hr>
                                 {{ Auth::user()->nombre }}
                                
                                <small>{{ Auth::user()->roles[0]->name}}</small>
                            </p>
                       </li>
                            <li>
                                <hr>
                                  <li class="user-footer">
                                     
                                <div class="pull-left">
                                  
                                <!-- <a class="btn btn btn-flat bg-dark" style="border-radius: 5px;" href="#">Perfil</i></a> -->
                               
                                <!-- <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">Perfil</a> -->
                            </div>
                                     <div class="pull-right">
                                        <a class="btn btn btn-flat bg-dark" style="border-radius: 5px;" href="{{ url('/logout') }}">Logout</i></a>
                                    </div>  
                                  </li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                   
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
