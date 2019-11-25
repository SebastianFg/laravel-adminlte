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

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->nombre }} 
                    </a>
                    <div class="col-md-12">

                        <ul class="dropdown-menu bg-dark" role="menu">
                            <li>

                                  <li class="user-footer">
            {{--                         <div class="pull-left">
                                      <a href="#" class="btn btn-info btn-flat"  style="border-radius: 5px;">Profile</a>
                                    </div> --}}
                                    <div class="pull-right">
                                        <img src="images/pdf_iimages/logosp.png">
                                        <a class="btn btn-info btn-flat" style="border-radius: 5px;" href="{{ url('/logout') }}"> <i class="fa fa-power-off"> Logout</i></a>
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
<!-- /.navbar -->

<style type="text/css">
    .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}
</style>