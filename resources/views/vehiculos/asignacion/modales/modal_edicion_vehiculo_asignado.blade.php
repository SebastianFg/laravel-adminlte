
  <div class="modal fade" id="modaEdicionAsignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Editar asignacion del vehiculo</h4>
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
              <div class="modal-body">
                <form action="{{ url('admin/editar_asignacion') }}" class="form-group" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group col-md-6">
                     <label>Vehiculo</label>
                     <br>
                     <input class="form-control" type="text" readonly="" name="nombre_editar_vehiculo_asignado" id="id_editar_vehiculo_asignado">

                     <input class="form-control col-md-6" type="text" style="display: none;" hidden="" name="vehiculo" id="id_vehiculo_edicion">

                     <input class="form-control col-md-6" type="text" style="display: none;" hidden="" name="detalle" id="id_detalle">
                  </div>
                  <div class="form-group col-md-6">
                      <label>Seleccione Afectado</label>
                      <br>
                      <div id="select_edicion">
                          <select type="text" class="form-control" id="id_afectado_edicion" onchange="getComboA(this)" data-width="100%" name="id_afectado">
                          </select>
                      </div>
                  </div>
                  <div class="col-md-12" id="div_mandatario" style="display:none;">

                    <label>Ingrese mandatario o dignatario</label>
                    <br>
                    <input class="form-control" name="man_destinatario"  placeholder="Ingrese mandatario, dignatario o observacion de asignacion" >
  
                     <label >Ingrese ente</label>
                     <br>
                    <input class="form-control " name="ente_destinatario" placeholder="Ingrese nombre del ente" name="">
                  </div>
                  <br>
                  <div class="col-md-12" id="div_separacion"></div>

     {{--              <div class="form-group col-md-6">
                    <label>Entregado por</label>
                    <br>
                    <input type="text" name="entrego" id="id_responsable_edicion" placeholder="Entregado por" required class="form-control ">
                  </div> --}}
                  <input type="text" name="id_usuario" hidden="" value="{{ Auth::User()->id }}" placeholder="Entregado por" required class="form-control ">

                  <div class="form-group col-md-6">
                      <label>Fecha</label>
                      <br>
                      <input type="date" id="id_fecha_edicion"  name="fecha" class="form-control " required >
                  </div> 

                  <div class="form-group col-md-12">
                      <label for="">Observaciones</label>
                      <textarea type="text" name="otros" id="id_observaciones_edicion" placeholder="Observaciones" class="form-control" required></textarea>
                  </div>

                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                    <a href="{{ url('asignar_vehiculos') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                  </div>            
                </form>
              </div>
          </div>
      </div>
    </div>

