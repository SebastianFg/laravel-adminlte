
  <div class="modal fade" id="modalBajaJuzgado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-md-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Baja del juzgado DP</h4>
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
          <form action="{{ route('eliminarJuzgado') }}" class="form-group" method="POST"enctype="multipart/form-data" >
              @csrf
              <div class="row">
                
                <div class="form-group col-md-12"  >
                  <label>Juzgado</label>
                  <input type="text" readonly="" hidden id="id_juzgado_eliminar" name="id_juzgado_eliminar" class="form-control">
                  <input class="form-control" type="text" readonly="" autocomplete="off"  id="id_nombre_juzgado_eliminar">
                </div>
              </div>

              <div class="col-md-12 modal-footer" >
                  <button class="btn btn-success col-md-2 d-inline" type="submit">Aceptar</button>
                  <a class="btn btn-danger col-md-2 d-inline" href="{{ route('indexJuzgado') }}">Cancelar</a> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



