
<div class="modal fade" id="idModalAsignacionBorrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Eliminar Asignación</h4>
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
                <form action="{{ route('eliminarAsignacion') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" hidden="" name="id_detalle" id="id_detalle_asignacion">
                        <label>Vehiculo</label>
                        <input type="text" readonly="" class="form-control" id="id_nombre_vehiculo_eliminado">
                        <input type="text"  class="form-control"  hidden="" name="id_identificacion_vehiculo_eliminado"  id="id_identificacion_vehiculo_eliminado">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Afectado actual</label>
                        <input type="text" hidden="" name="id_afectado_eliminado" id="id_afectado_eliminado">
                        <input type="text" readonly="" class="form-control" id="id_nombre_afectado_eliminado">
                    </div>
                  </div>
                  <div class="row">
                  </div>
{{--                   <div class="form-group col-md-12">
                      <label for="">Observaciones</label>
                      <textarea type="text" name="otros" placeholder="Observaciones" class="form-control" value="{{ old('otros') }}"></textarea>
                  </div> --}}


                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline" id="btnSubmit" type="submit">Guardar</button>
                      <button class="btn btn-danger col-md-4 d-inline" data-dismiss="modal">Cancelar</button>  
                  </div>
                              
                </form>

                </div>
              </div>
          </div>
      </div>
    </div>


