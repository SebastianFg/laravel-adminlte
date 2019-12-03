<div class="panel panel-success"> 
  <div class="modal fade" id="idModalAltaSiniestro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          <form  action="{{ route('altaSiniestro') }}"  class="form-group" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label>Seleccione Vehiculo</label>
                <br>
                <div id="select">
                    <select type="text" class="form-control" id="id_vehiculo" data-width="100%" name="id_vehiculo">
                    </select>
                </div>
              </div>
              <div class="form-group col-md-6">
                 <label>Lesionados</label>
                 <select class="form-control" name="id_lesionados">
                   <option value="0" selected>No</option>
                   <option value="1">Si</option>
                 </select>
                  
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                  <label for="">Fecha Siniestro</label>
                  <input type="date"  name="fecha_siniestro" class="form-control" required >
              </div>
              <div class="form-group col-md-6">
                  <label for="">Fecha Presentacion ante el seguro</label>
                  <input type="date"  name="fecha_presentacion" class="form-control" required >
              </div> 
            </div>
            <input type="text" hidden="" name="id_usuario" value="{{ Auth::user()->id }}">
            <div class="row">
              <div class="form-group col-md-12">
                  <label for="">Lugar</label>
                  <textarea type="text" name="lugar_siniestro"  maxlength="191" autocomplete="off" placeholder="Lugar del siniestro" class="form-control" required ></textarea>
              </div>
              <div class="form-group col-md-12">
                  <label for="">Descripción</label>
                  <textarea type="text" name="descripcion_siniestro"  maxlength="191" autocomplete="off" placeholder="Ingrese descripcion del siniestro" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group col-md-12">
                <label for="">Observaciones</label>
                <textarea type="text" name="observaciones_siniestro"  maxlength="191"  autocomplete="off" placeholder="Ingrese alguna observacion" class="form-control"></textarea>
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


