<div class="panel panel-success"> 
  <div class="modal fade" id="idModalAsignacionRepuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Asignar Repuesto</h4>
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
          <form action="{{ route('asignarRepuesto') }}" class="form-group" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              
               <div class="form-group col-md-6">
                  <label>Seleccione Vehiculo</label>
                  <br>
                  <div id="select">
                      <select type="text" class="form-control" id="id_vehiculo"data-width="100%" name="id_vehiculo">
                      </select>
                  </div>
              </div>
              <div class="form-group col-md-6">
                  <label for="">Fecha</label>
                  <input type="date"  name="fecha" class="form-control" required >
              </div> 
            </div>
            <input type="text" name="id_usuario" readonly="" hidden="" placeholder="Entregado por" required class="form-control " value="{{ Auth::User()->id }}">
            <div class="form-group col-md-12">
                <label for="">Repuestos Entregados</label>
                <textarea type="text" name="repuestos_entregados" autocomplete="off" placeholder="Repuestos entregados" class="form-control" required value="{{ old('repuestos_entregados') }}"></textarea>
            </div>

{{--             <div class="form-group col-md-12">
                <label for="">Seleccione PDF</label>
                <input type="file" name="pdfrepuestos" required="" >
                
            </div> --}}

            <div class="col-md-12 modal-footer" style="position:relative;">
                <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-4 d-inline" href="{{ route('listaRepuestos') }}">Cancelar</a>
            </div>
                              
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


