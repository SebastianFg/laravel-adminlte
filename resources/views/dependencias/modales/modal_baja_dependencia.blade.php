
  <div class="modal fade" id="idModalBajaDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar dependencia</h4>
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
              <form action="{{ route('bajaDependencia') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-12">
                      <label>Ingrese Nombre de la Dependencia</label>
                      <input type="text" readonly="" autocomplete="off" name="nombre_dependencia" id="id_nombre_dependencia_hijo_eliminar" class="form-control" >
                      <input type="text" hidden="" name="id_dependencia" id="id_dependencia_eliminar" class="form-control" >
                      <input type="text" hidden="" name="id_nivel" id="id_nivel" class="form-control" >
                  </div>
                <div class="col-md-12 modal-footer" style="position:relative;">
                    <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a href="{{ route('indexDependencia') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                </div>            
              </form>
            </div>
        </div>
    </div>
  </div>
