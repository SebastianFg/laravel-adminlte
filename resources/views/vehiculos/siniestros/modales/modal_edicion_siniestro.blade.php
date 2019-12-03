<div class="panel panel-success"> 
  <div class="modal fade" id="idModalEdicionSiniestro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Nuevo Siniestro</h4>
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
          <form  action="{{ route('EditarSiniestro') }}"  class="form-group" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="form-group col-md-6">
                  <label>Vehiculo</label>
                  <br>
                  <input type="text" name="id_vehiculo" hidden id="id_vehiculo_siniestro">
                  <input type="text" name="id_siniestro" hidden id="id_siniestro">
                  <input type="text" name="id_identificacion_interna"  autocomplete="off"class="form-control " readonly=""  id="id_identificacion_interna">
              </div>
              <div class="form-group col-md-6">
                 <label>Lesionados</label>
                 <select class="form-control" name="id_lesionados"  autocomplete="off"id="id_lesionados">
                   <option value="0" selected>No</option>
                   <option value="1">Si</option>
                 </select>
              </div>
            </div>
            <input type="text" hidden="" name="id_usuario"  autocomplete="off"value="{{ Auth::user()->id }}">
            <div class="row">
              <div class="form-group col-md-6">
                  <label for="">Fecha Siniestro</label>
                  <input type="date"  name="fecha_siniestro" id="id_fecha_siniestro" class="form-control" required >
              </div>
              <div class="form-group col-md-6">
                  <label for="">Fecha Presentación</label>
                  <input type="date"  name="fecha_presentacion" id="id_fecha_presentacion" class="form-control" required >
              </div> 
            </div>
            <div class="form-group col-md-12">
                <label for="">Lugar</label>
                <textarea type="text" name="lugar_siniestro" autocomplete="off" id="id_lugar_siniestro" placeholder="Lugar del siniestro" class="form-control" required ></textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="">Observaciones</label>
                <textarea type="text" name="observaciones_siniestro" autocomplete="off" id="id_observaciones_siniestro" placeholder="Ingrese alguna observacion" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="">Descripción</label>
                <textarea type="text" name="descripcion_siniestro" autocomplete="off" id="id_descripcion_siniestro" placeholder="Ingrese descripcion del siniestro" class="form-control"></textarea>
            </div>

            <div class="form-group col-md-12">
                <label for="">Seleccione PDF</label>
                <input type="file" name="pdf_siniestro" >
                
            </div>

            <div class="col-md-12 modal-footer" style="position:relative;">
                <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-4 d-inline" href="{{ route('indexSiniestros') }}">Cancelar</a>
            </div>
                              
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


