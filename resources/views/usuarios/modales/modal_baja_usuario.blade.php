
  <div class="modal fade" id="modalBajaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Baja de usuario</h4>
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
          <form action="{{ route('eliminarUsuario') }}" class="form-group" method="POST"enctype="multipart/form-data" >
              @csrf
              <div class="row">
                
                <div class="form-group col-md-6"  >
                  <label>Nombre Y Apellido</label>
                  <br>
                  <input autocomplete="off" type="text" readonly="" hidden="" id="id_usuario_baja" class="form-control" name="id_usuario" >
                  <input class="form-control" type="text" readonly=""  id="id_nombre_apellido" name="id_nombre_apellido" >
                  
                  <input type="text" value="{{ Auth::user()->id }}" hidden name="id_usuario_movimiento">
                  <div class="form-group col-md-6">
                    
                  </div>
                </div>
                <div class="form-group col-md-6"  >
                  <label>Usuario</label>
                  <br>
                  <input class="form-control" type="text" readonly=""  id="id_nombre_usuario" name="id_nombre_usuario" >
                </div>

                <div class="form-group col-md-12">
                    <label for="">Motivo de baja</label>
                    <textarea type="text" name="motivo_de_baja" placeholder="Motivo de la baja" class="form-control" value="{{ old('motivo_de_baja') }}"></textarea>
                    {{-- <input type="text" name="otros" placeholder="Otras Caracteristicas" class="form-control" required value="{{ old('otros') }}"> --}}
                </div>

              <div class="col-md-12 modal-footer" >
                  <button class="btn btn-success col-md-2 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-2 d-inline" href="{{ route('listaUsuarios') }}">Cancelar</a> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



