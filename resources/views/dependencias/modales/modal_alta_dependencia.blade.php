
  <div class="modal fade" id="miModalDependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nueva dependencia</h4>
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
                      <label>Ingrese Nombre de la Dependencia</label>
                      <input type="" name="nombre_dependencia" class="form-control" >
                      
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                      <input type="radio" name="eleccion" value="1" > Direccion General
                      <br>
                      <input type="radio" name="eleccion"   value="2"> Direccion 
                      <br>
                      <input type="radio" name="eleccion" value="3" > Departamento
                      <br>
                      <input type="radio" name="eleccion"   value="4"> Division
                      <br>
                      <input type="radio" name="eleccion"   value="5"> Seccion
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
