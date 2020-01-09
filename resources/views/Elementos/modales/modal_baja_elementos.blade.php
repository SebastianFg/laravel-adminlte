
  <div class="modal fade" id="modalBajaElementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Baja de elementos</h4>
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
          <form action="{{ route('eliminarElementos') }}" class="form-group" method="POST"enctype="multipart/form-data" >
              @csrf
              <div class="row">
                
                <div class="form-group col-md-6"  >
                  <label>Elemento</label>
                  <br>
                  <input type="text" readonly="" hidden="" id="id_elemento_baja" class="form-control" name="elemento" >
                  <input class="form-control" type="text" readonly="" autocomplete="off"  id="id_descripcion_baja" name="descripcion" >
                  <input type="text" value="{{ Auth::user()->id }}" hidden name="id_usuario">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Fecha</label>
                    <input type="datetime" readonly="" value="<?php echo date("d-m-Y H:i:s");?>"  name="fecha" min="<?php echo date("Y-m-d");?>" class="form-control" required >
                </div> 
              <div class="col-md-12 modal-footer" >
                  <button class="btn btn-success col-md-2 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-2 d-inline" href="{{ route('listaVehiculos') }}">Cancelar</a> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



