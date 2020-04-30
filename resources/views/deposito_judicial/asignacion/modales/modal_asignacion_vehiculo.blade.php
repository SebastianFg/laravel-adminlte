
<div class="modal fade" id="modalAsignacionDepositoJudicial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form action="{{route('crearAsignacionDepositoJudicial')}}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Seleccione vehículo</label>
                        <div id="select_vehiculo">
                            <select type="text" class="form-control"required id="id_vehiculo_deposito_judicial" value="{{ old('vehiculo') }}" data-width="100%" name="id_vehiculo_deposito_judicial">
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Fecha</label>
                        <input type="date"  id="myDatetimeField" required  name="fecha" class="form-control" value="{{ old('fecha') }}" >
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label>Seleccione la dependencia a la que pertenece actualmente el responsable</label>
                        <div id="select_afectado">
                            <select type="text" class="form-control"required value="{{ old('dependencia') }}" id="id_afectado" data-width="100%" name="dependencia">
                            </select>
                        </div>
                    </div>
                  </div>
{{--                   <div class="row" id="mandatario_dignatario_deposito_judicial" style="display:none;">
                    <div class="form-group col-md-6">
                        <label>Entidad</label>
                        <div id="select">
                            <input type="text" maxlength="100"  class="form-control" title="Ingrese nombre de la entidad que va a ser asignada el vehiculo" placeholder="Ingrese nombre de la entidad a la cual se le asigna el vehiculo" name="entidad">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mnadatario o Dignatario</label>
                        <div id="select">
                            <input type="text"  maxlength="100" class="form-control" title="ingrese nombre de la persona que el vehiculo fue asignado, en caso de que no haya un responsable, ingresar nombre de la persona que retira el vehículo" placeholder="Ingrese nombre de mandatario o dignatario designado" name="persona">
                        </div>
                    </div>
                  </div> --}}
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese el Kilometraje que posee el vehiculo">Exp-Of</label>
                        <input type="text" name="expof" autocomplete="off" id="id_expof_modificacion" placeholder="Ingrese EXP - OF" class="form-control" value="{{ old('expof') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese el PDF deposito judicial">PDF Depósito Judicial </label>
                        <input type="file" name="notadecreto" autocomplete="off"  value="{{ old('notadecreto') }}">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese quien solicito el vehículo">Solicitado por</label>
                        <input type="text" name="solicitado" autocomplete="off" id="id_solicitado" placeholder="Ingrese quien lo solicito" class="form-control" value="{{ old('solicitado') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese quien entego el vehículo">Titular de entrega</label>
                        <input type="text" name="titular_entrega" autocomplete="off" id="id_titular_entrega" placeholder="Ingrese quien entego el vehículo" class="form-control" value="{{ old('titular_entrega') }}">
                    </div>  
                  </div>
                  <div class="form-group">
                      <label title="Seleccione la dependencia">Responsable </label>
                      <input type="text" name="responsable_vehiculo" autocomplete="off" id="id_responsable" placeholder="Ingrese quien es el responsable del vehículo" class="form-control" value="{{ old('responsable_vehiculo') }}">
                  </div> 
                  <div class="form-group col-md-12">
                      <label for="">Observaciones</label>
                      <textarea type="text" name="observaciones" autocomplete="off" placeholder="Observaciones" class="form-control" required value="{{ old('otros') }}"></textarea>
                  </div>


                  <div class="col-md-12 modal-footer" style="position:relative;">
                      <button class="btn btn-success col-md-4 d-inline"  type="submit">Guardar</button>
                      <button class="btn btn-danger col-md-4 d-inline" data-dismiss="modal">Cancelar</button>  
                  </div>
                              
                </form>

                </div>
              </div>
          </div>
      </div>
    </div>

