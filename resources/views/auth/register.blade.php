@extends('layouts.master') 
@section('content')

<body class="hold-transition register-page">
  <div class="register-box ">
    <div class="register-logo">
      Patrimonio
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">{{ __('Registro') }}</p>

        <form action="{{ route('register') }}" method="post">
          @csrf
          <label>Nombre y Apellido</label>
          <div class="input-group mb-3">
            <span class="fa fa-user input-group-text"></span>
            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese su nombre completo"
              required autofocus> 
            @if ($errors->has('nombre'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nombre') }}</strong>
              </span> 
            @endif
          </div>
          <label>Usuario</label>
          <div class="input-group mb-3">
            <span class="fa fa-user input-group-text"></span> 
            <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" placeholder="Ingrese nombre de usuario">
              @if ($errors->has('usuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span> 
              @endif

          </div>
          <label>Contraseña</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span> 
            @endif
          </div>
          <label>Confirmar contraseña</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="ingrese nuevamente su contraseña" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span> 
            @endif
          </div>
          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
            </div>
          </div>
        </form>
        <a href="{{route('login')}}" class="text-center">Ya tengo cuenta</a>
      </div>
      <!-- /.form-box -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection