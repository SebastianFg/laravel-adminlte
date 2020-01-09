
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Agregar Elementos</h4>
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
                <form action="{{ route('elementos.crearElementos') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Descripcion del elemento</label>
                        <input type="text" name="descripcion" autocomplete="off" maxlength="80" placeholder="ingrese descripcion" required class="form-control md-2" value="{{ old('descripcion') }}"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Fecha</label>
                        <input type="date"  id="myDatetimeField"  name="fecha" class="form-control" value="{{ old('fecha') }}" >
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Modelo</label>
                        <input type="text" name="modelo" autocomplete="off" maxlength="50" placeholder="ingrese modelo"  class="form-control" required value="{{ old('modelo') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Marca</label>
                        <input type="text" name="marca" autocomplete="off" maxlength="50"  placeholder="ingrese modelo" maxlength="50" class="form-control" required value="{{ old('marca') }}">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Serial</label>
                        <input type="text" name="serial" autocomplete="off" placeholder="ingrese serial" maxlength="20" class="form-control" required value="{{ old('serial') }}">
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


