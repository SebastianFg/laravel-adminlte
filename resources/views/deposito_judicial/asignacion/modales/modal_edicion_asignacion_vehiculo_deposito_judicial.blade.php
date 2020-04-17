
<div class="modal fade" id="modalEdicionAsignacionDepositoJudicial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Asignar vehículo DP</h4>
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
                <form action="{{route('editarAsignacionDepositoJudicial')}}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" readonly="" hidden="" class="form-control" name="id_detalle_asignacion_vehiculo" id="id_detalle_asignacion_vehiculo">
                        <label>Seleccione vehículo</label>
                        <div id="select_edicion_vehiculo">
                            <select type="text" class="form-control" id="id_vehiculo_deposito_judicial_edicion" value="{{ old('vehiculo') }}" data-width="100%" name="id_vehiculo_deposito_judicial">
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Fecha</label>
                        <input type="date"  id="id_fecha_deposito_judicial_edicion"   name="fecha" class="form-control" value="{{ old('fecha') }}" >
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label>Seleccione afectado</label>
                        <div id="select_edicion_afectado">
                            <select type="text" class="form-control" id="id_afectado_edicion" value="{{ old('afectado') }}" data-width="100%" name="afectado">
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row" id="mandatario_dignatario" style="display:none;">
                    <div class="form-group col-md-6">
                        <label>Entidad</label>
                        <div id="select">
                            <input type="text" maxlength="100"  class="form-control" title="Ingrese nombre de la entidad que va a ser asignada el vehiculo" id="id_entidad_deposito_judicial_edicion" placeholder="Ingrese nombre de la entidad a la cual se le asigna el vehiculo" name="entidad">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mnadatario o Dignatario</label>
                        <div id="select">
                            <input type="text"  maxlength="100" id="id_persona_deposito_judicial_edicion" class="form-control" title="ingrese nombre de la persona que el vehiculo fue asignado, en caso de que no haya un responsable, ingresar nombre de la persona que retira el vehículo" placeholder="Ingrese nombre de mandatario o dignatario designado" name="persona">
                        </div>
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                      <label for="">Observaciones</label>
                      <textarea type="text" name="otros" autocomplete="off" id="id_obs_deposito_judicial_edicion" placeholder="Observaciones" class="form-control"  value="{{ old('otros') }}"></textarea>
                  </div>


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

