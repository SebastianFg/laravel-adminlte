@extends('layouts.master') 
@section('content')

<body class="hold-transition register-page">
  <div class="register-box ">
    <div class="register-logo">
      Primer Ingreso
    </div>
    <hr>
    <p><i class="fa fa-bullseye"><strong>  Recuerde que la contraseña nueva TIENE que ser diferente a la antigua</strong></i></p>
    <div class="card">
        @if(!$errors->isEmpty())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach()
            </ul>
          </div>
        @endif
      <div class="card-body ">
        <form action="{{ route('cambioPrimerPassword') }}" method="post">
          @csrf
{{-- 
          <label>Contraseña antigua</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_antigua" placeholder="Contraseña antigua" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span> 
            @endif
          </div> --}}
          <label>Nueva Contraseña</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_nueva" placeholder="Contraseña nueva" required>
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
            <div class="col-md-12 modal-footer" style="position:relative;">
                <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
              	<a href="{{ url('/logout') }}" class="col-md-4 d-inline btn btn-danger">Salir</a>
            </div> 
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection