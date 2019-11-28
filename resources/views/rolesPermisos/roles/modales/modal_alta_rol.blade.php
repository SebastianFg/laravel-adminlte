
<div class="modal fade" id="idModalAlta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	                <form action="{{ route('crearRol') }}" class="form-group" method="POST" enctype="multipart/form-data">
		                @csrf
		                <div class="row">
		                    <div class="form-group ">
		                        <label>Nombre Rol</label>
		                        <input type="text" name="nombre_rol" autocomplete="off" maxlength="20" placeholder="ingrese nombre del rol" required class="form-control md-2" value="{{ old('nombre_rol') }}"> 
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


