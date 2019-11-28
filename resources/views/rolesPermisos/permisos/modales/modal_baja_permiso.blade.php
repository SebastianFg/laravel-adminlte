
<div class="modal fade" id="idModalBaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog bd-example-modal-sm" role="document">
          <div class="modal-content col-md-6">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Agregar Rol</h4>
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
              <div class="modal-body center ">
                  <form action="{{ route('eliminarPermiso') }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group ">
                            <label>Permiso</label>
                             <input type="text" hidden="" name="id_permiso" id="id_permiso_baja"  required value="{{ old('id_permiso') }}"> 
                            <input type="text" readonly="" autocomplete="off" name="nombre_permiso" id="id_nombre_permiso_baja" required class="form-control md-2" value="{{ old('nombre_permiso') }}"> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success d-inline " id="btnSubmit" type="submit">Guardar</button>
                        <button class="btn btn-danger  d-inline mr-auto " data-dismiss="modal">Cancelar</button>  
                    </div>            
                  </form>
                </div>
              </div>
          </div>
      </div>
    </div>


