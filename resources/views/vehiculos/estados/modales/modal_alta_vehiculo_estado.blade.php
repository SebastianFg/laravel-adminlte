
<div class="modal fade" id="modalAltaVehiculoEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Agregar Vehiculo</h4>
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
              <form action="{{ route('altaEstadoVehiculo') }}" class="form-group" method="POST"enctype="multipart/form-data" >
                @csrf
                <div class="panel-body">
                  <div class="row">
                    <div class="form-group col-md-6"  >
                        <label>Vehiculo</label>
                        <input type="text" readonly="" id="id_vehiculo_dominio_alta" class="form-control" value="Dominio: ">
                        <input type="text" readonly="" id="id_vehiculo" hidden value="" class="form-control"  name="id_vehiculo_reparado">
                        
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Fecha</label>
                        <input type="datetime" readonly="" value="<?php echo date("d-m-Y H:i:s");?>"  name="fecha" min="<?php echo date("Y-m-d");?>" class="form-control" required >
                    </div> 
                  </div>
                  <div class="form-group col-md-12">
                      <label for="">Motivo de alta</label>
                      <textarea type="text" name="motivo_de_alta" autocomplete="off" placeholder="Motivo de alta" class="form-control" value="{{ old('observaciones') }}"></textarea>
                  </div>

                  <div class="col-md-12 modal-footer" style="position:relative;">
                    <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                    <a class="btn btn-danger col-md-4 d-inline" href="{{ route('listadoEstadoVehiculo') }}">Cancelar</a>
                  </div>
                </div>  
              </form>
            </div>
          </div>
      </div>
    </div>

