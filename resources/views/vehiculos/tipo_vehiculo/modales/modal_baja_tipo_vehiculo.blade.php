
<div class="modal fade" id="modalBajaTipoVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Eliminar Tipo Vehiculo</h4>
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
              <div class="modal-body ">
                <form action="{{ route('eliminarTipoVehiculo') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label>Tipo Vehiculo</label>
                        <input type="text" readonly="" id="id_nombre_tipo_vehiculo_baja" name="nombre_tipo_vehiculo_baja" autocomplete="off" maxlength="6" placeholder="tipo vehiculo" required class="form-control md-2" value="{{ old('nombre_tipo_vehiculo_editar') }}"> 
                        <input type="text" hidden="" name="id_tipo_vehiculo" id="id_tipo_vehiculo_baja">
                    </div>    

                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                      <a href="{{ route('listaTipoVehiculos') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                  </div>   
                </form>

                </div>
              </div>
          </div>
      </div>
    </div>


