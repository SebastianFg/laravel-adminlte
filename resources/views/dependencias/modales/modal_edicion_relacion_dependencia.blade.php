
  <div class="modal fade" id="modalEdicionRelacionDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Asignar Dependencias</h4>
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
              <form action="{{ route('edicionRelacion') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-6">
                      <label>Seleccione Padre</label>
                      <br>
                      <div id="select1_edicion">
                          <select type="text" class="form-control" id="id_padre_edicion"  data-width="100%" name="padre">
                          </select>
                      </div>
                  </div>
                  <input type="text" name="detalle" hidden="" id="id_detalle">
                  <div class="form-group col-md-6">
                      <label>Seleccione Hijo</label>
                      <br>
                      <div id="select2_edicion">
                          <select type="text" class="form-control" id="id_hijo_edicion"  data-width="100%" name="hijo">
                          </select>
                      </div>
                  </div>
                <div class="col-md-12 modal-footer" style="position:relative;">
                    <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a href="{{ route('cargaRelaciones') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                </div>            
              </form>
            </div>
        </div>
    </div>
  </div>
