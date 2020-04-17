
<div class="modal fade" id="modalAltaJuzgado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Agregar Juzgado DP</h4>
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
                <form action="{{route('altaJuzgado')}}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label title="Nombre del juzgado">Nombre del juzgado</label>
                        <input type="text" name="nombre_juzgado" autocomplete="off" placeholder="Nombre del juzgado" required class="form-control md-2" value="{{ old('nombre_juzgado') }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese la direccion del juzgado">Dirección</label>
                        <input type="text" name="direccion_juzgado" autocomplete="off"  placeholder="Dirección"  class="form-control" required value="{{ old('direccion_juzgado') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número de telefono">Telélefono</label>
                        <input type="number" name="telefono_juzgado" autocomplete="off"   placeholder="Telélefono" maxlength="50" class="form-control" required value="{{ old('telefono_juzgado') }}">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label title="Ingrese el responsable del juzgadoo">Responsable</label>
                        <input type="text" name="responsable_juzgado" autocomplete="off"   placeholder="Responsable" maxlength="20" class="form-control" required value="{{ old('responsable_juzgado') }}">
                    </div> 
                  </div>
                  
                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline" id="btnSubmitAlta" type="submit">Guardar</button>
                      <button class="btn btn-danger col-md-4 d-inline" data-dismiss="modal">Cancelar</button>  
                  </div>
                              
                </form>

                </div>
              </div>
          </div>
      </div>
    </div>


