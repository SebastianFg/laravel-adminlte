
  <div class="modal fade" id="modalEdicionDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
              <form action="{{ route('edicionDependencia') }}" name="edicion" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-12">
                      <label>Ingrese Nombre de la Dependencia</label>
                      <input type="text" name="nombre_dependencia" id="id_nombre_dependencia" class="form-control" >
                      <input type="text" hidden="" name="id_dependencia" id="id_dependencia" class="form-control" >
                      
                  </div>
                  <div class="form-group col-md-6">
                      <label>Que es?</label>
                      <br>
                      <input type="radio" name="eleccion" id="id_dir_gen" value="1" > Direccion General
                      <br>
                      <input type="radio" name="eleccion" id="id_dir" value="2"> Direccion 
                      <br>
                      <input type="radio" name="eleccion" id="id_dep" value="3" > Departamento
                      <br>
                      <input type="radio" name="eleccion" id="id_div_radio" value="4"> Division
                      <br>
                      <input type="radio" name="eleccion" id="id_sec" value="5"> Seccion
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
