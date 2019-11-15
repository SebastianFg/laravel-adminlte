<div class="modal fade" id="modalBajaDefinitivaVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Baja Definitiva Vehiculos</h4>
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
        <form action="{{ route('bajaDefinitiva') }}" class="form-group" method="POST"enctype="multipart/form-data" >
          @csrf
          <div class="panel-body">
            <div class="row">
              
              <div class="form-group col-md-6"  >
                  <label>Vehiculo</label>
                  <input type="text" readonly="" id="dominio_vehiculo_baja" class="form-control" value="Dominio: ">
                  <input type="text" readonly="" id="id_vehiculo_baja" hidden  class="form-control"  name="id_vehiculo_baja">
                  <input type="text" readonly="" id="id_vehiculo_estado" hidden  class="form-control"  name="id_vehiculo_estado">
              </div>
              <div class="form-group col-md-6">
                  <label for="">Fecha</label>
                  <input type="datetime" readonly="" value="<?php echo date("d-m-Y");?>"  name="fecha" class="form-control" required >
              </div> 
            </div>

            <div class="form-group col-md-12">
                <label for="">Motivo de la baja</label>
                <textarea type="text" name="motivo_de_baja_definitiva" placeholder="Motivo de baja" class="form-control" value="{{ old('motivo_de_baja_definitiva') }}"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="">Seleccione PDF</label>
                <input type="file" name="pdf_decreto_baja_definitiva" required>
                
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

