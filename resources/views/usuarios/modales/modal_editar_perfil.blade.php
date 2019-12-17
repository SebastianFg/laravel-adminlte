<div class="modal fade" id="modalEditarPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
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
        <form action="{{ route('editarPerfil') }}" enctype="multipart/form-data" method="post">
          @csrf
          <label>Contraseña</label>
          <label>Nueva Contraseña</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password" type="password" autocomplete="on" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_nueva" placeholder="Contraseña nueva" >
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span> 
            @endif
          </div>
          <label>Confirmar contraseña</label>
          <div class="input-group mb-3">
            <span class="fa fa-lock input-group-text"></span> 
            <input id="password-confirm" type="password" class="form-control" autocomplete="on" name="password_confirmation" placeholder="ingrese nuevamente su contraseña" >
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span> 
            @endif
          </div>
          <label>Foto</label>
          <div class="input-group mb-3">
        
            <input type="file" accept="image/*"  name="foto"> 
          </div>

          <div class="row">

            <div class="col-md-12 modal-footer" style="position:relative;">
                <button class="btn btn-success col-md-4 d-inline" id="btnSubmit" type="submit">Guardar</button>
                <button class="btn btn-danger col-md-4 d-inline" data-dismiss="modal">Cancelar</button>  
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>



