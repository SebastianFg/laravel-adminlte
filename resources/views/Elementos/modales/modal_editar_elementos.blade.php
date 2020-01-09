
<div class="modal fade" id="modalEdicionElemento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Editar Elemento</h4>
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
                <form action="{{ route('updateElementos') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf 
                  <div class="row">
                    <div class="form-group col-md-6">
                    <input type="text" name="elemento" hidden="" id="id_elementos" >     
                        <label>Descripcion</label>
                        <input type="text" id="id_descripcion_elementos"  name="descripcion" autocomplete="off" maxlength="250" placeholder="ingrese descripcion" required class="form-control md-2" value="{{ old('descripcion') }}"> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Fecha</label>
                      <input type="date"  id="id_fecha_elementos"  name="fecha" class="form-control"  >
                    </div> 
                  </div>

                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Modelo</label>
                        <input type="text" name="modelo" autocomplete="off" id="id_modelo_elementos" placeholder="ingrese modelo"  class="form-control" required value="{{ old('modelo') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Marca</label>
                        <input type="text" name="marca" autocomplete="off" id="id_marca_elementos" placeholder="marca" maxlength="250" class="form-control" required value="{{ old('marca') }}">
                    </div> 
                  </div>
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Serial</label>
                        <input type="text" name="serial" autocomplete="off" id="id_serial_elementos" placeholder="serial" maxlength="250" class="form-control" required value="{{ old('serial') }}">
                    </div> 
                    
                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline" id="btnSubmitEdit" type="submit">Guardar</button>
                      <button class="btn btn-danger col-md-4 d-inline" data-dismiss="modal">Cancelar</button>  
                  </div>
                              
                </form>
                </div>
              </div>
          </div>
      </div>
    </div>


