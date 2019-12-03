
  <div class="modal fade" id="miModalDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nueva Dependencia</h4>
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
              <form action="{{ route('altaDependencia') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="form-group col-md-12">
                      <label>Ingrese Nombre de la nueva Dependencia</label>
                      <input type="" autocomplete="off" name="nombre_dependencia" class="form-control" >
                      
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label>Tipo Dependencia</label>
                    <select name="nivel_dependencia" id="IdnivelDependencia" class="form-control">
                      <option value="">Seleccione un tipo de dependencia</option>
                      <option value="3">Dirección General</option>
                      <option value="4">Dirección</option>
                      <option value="5">Departamento</option>
                      <option value="6">División</option>
                      <option value="7">Sección</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Dependencia padre</label>
                    <select name="dependencia_habilitada_padre" id="id_dependencia_habilitada" class="form-control">
                      <option>Seleccione una dependencia padre</option>
                    </select>
                  </div>
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
