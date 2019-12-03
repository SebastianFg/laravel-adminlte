
  <div class="modal fade" id="idModalEdicionDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              <form action="{{ route('editarDependencia') }}" name="edicion" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-12">
                      <label>Ingrese Nombre de la Dependencia</label>
                      <input type="text" autocomplete="off" name="nombre_dependencia_edicion" id="id_nombre_dependencia_editar" class="form-control" >
                      <input type="text" hidden="" name="dependencia_edicion" id="id_dependencia_editar" class="form-control" >
                      
                  </div>
                <div class="row col-md-12">
                  <div class="form-group col-md-6">
                    <label>Tipo Dependencia</label>
                    <select name="nivel_dependencia_edicion" id="id_nivel_dependencia_edicion" class="form-control">
                      <option value="">Seleccione un tipo de Dependencia</option>
                      <option value="3">Dirección General</option>
                      <option value="4">Dirección</option>
                      <option value="5">Departamento</option>
                      <option value="6">División</option>
                      <option value="7">Sección</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Dependencia padre</label>
                    <select name="dependencia_habilitada_padre_edicion" id="id_dependencia_habilitada_padre" class="form-control">
                      <option value="">Seleccione una Dependencia padre</option>
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
