<div class="modal fade" id="modalAltaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
      </div>
      @if(!$errors->isEmpty())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach()
          </ul>
        </div>
      @endif
      <div class="modal-body col-md-12">
        <form action="{{ route('registroUsuario') }}" method="post">
          @csrf
          <label>Nombre y Apellido</label>
          <div class="input-group mb-3">
            <span class="fa fa-user input-group-text"></span>
            <input id="nombre" type="text" class="form-control" minlength="15" name="apellidoynombre" value="{{ old('apellidoynombre') }}" placeholder="Ingrese su nombre completo"
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
            <input id="usuario" type="text" class="form-control" minlength="4" name="usuario" value="{{ old('usuario') }}" placeholder="Ingrese nombre de usuario">
              @if ($errors->has('usuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('usuario') }}</strong>
                </span> 
              @endif

          </div>

          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>



