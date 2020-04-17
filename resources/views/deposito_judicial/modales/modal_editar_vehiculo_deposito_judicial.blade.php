
<div class="modal fade" id="modaEditarVehiculoDepositoJudicial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Editar vehículo DP</h4>
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
                <form action="{{ route('editarVehiculo') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label>Seleccione Juzgado</label>
                        <div id="select_deposito_judicial_vehiculo_editar">
                            <select type="text" class="form-control" id="id_juzgado_editar" value="{{ old('id_juzgado') }}" data-width="100%" name="id_juzgado">
                            </select>
                        </div>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" hidden id="id_vehiculo_deposito_judicial" name="id_vehiculo_deposito_judicial">
                        <label title="número de identificacion interna por ejemplo el vehiculo N° 3-720">Nº de Identificación</label>
                        <input type="text" name="numero_de_identificacion" id="id_numero_de_identificacion_editar" autocomplete="off" maxlength="6" placeholder="Número de identificacion" class="form-control md-2" value="{{ old('numero_de_identificacion') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label title="Fecha en la que se puso en funcionamiento dicho vehiculo">Fecha</label>
                        <input type="date"  id="id_fecha_editar"  name="fecha" class="form-control" value="{{ old('fecha') }}" >
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número de patente o dominio del vehiculo Ej EAG980. Ingresar sin - ni espacios">Dominio</label>
                        <input type="text" name="dominio" id="id_dominio_editar" autocomplete="off" maxlength="10" placeholder="Dominio: Ej-> AB123CD"  class="form-control" value="{{ old('dominio') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número de chasis del vehiculo">Chasis</label>
                        <input type="text" name="chasis" id="id_chasis_editar" autocomplete="off" maxlength="20"  placeholder="Chasis" maxlength="50" class="form-control" value="{{ old('chasis') }}">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número de motor de dicho vehiculo">Motor</label>
                        <input type="text" name="motor" id="id_motor_editar" autocomplete="off" maxlength="15"  placeholder="Motor" maxlength="20" class="form-control" value="{{ old('motor') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número del modelo del vehiculo, ejemplo, 2018">Modelo</label>
                        <input type="text" name="modelo" id="id_modelo_editar" autocomplete="off" placeholder="Modelo" maxlength="30" class="form-control" value="{{ old('modelo') }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese la marca del vehiculo, ejemplo, Ford | Chevrolet">Marca</label>
                        <input type="text" name="marca" id="id_marca_editar" autocomplete="off" placeholder="Marca"  maxlength="60" class="form-control" value="{{ old('marca') }}">
                    </div> 

                    <div class="form-group col-md-6">

                        <label title="Ingrese el año de produccion del vehiculo, ejemplo, 2018">Año de producción</label>
                        <input type="number"  name="anio_produccion" id="id_anio_produccion_editar" autocomplete="off" placeholder="Año de Produccion" class="form-control" value="{{ old('anio_produccion') }}">
                    </div> 
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese el número de inventario del vehiculo, ejemplo, 3000">Nº de inventario</label>
                        <input type="number" name="numero_de_inventario" id="id_numero_de_inventario_editar" autocomplete="off" placeholder="Numero de inventario: Ej-> 3000" class="form-control" value="{{ old('numero_de_inventario') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese la clase de unidad del vehiculo, ejemplo, cabina simple | 4x4 | cuatro puertas">Clase de unidad</label>
                        <input type="text" name="clase_de_unidad" id="id_clase_de_unidad" maxlength="50"  autocomplete="off" class="form-control" placeholder="Ej:cabina simple 4x2// doble cabina 4x4" value="{{ old('clase_de_unidad') }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">

                        <label title="Ingrese el tipo de vehiculo">Tipo de vehículo</label>
                        <select name="tipo"  id="id_tipo_editar" required class="form-control">
                          <option value="" selected="">Seleccione un vehículo</option>

                          @foreach ($tipo_vehiculo as $item)
             
                            <option od value="{{ $item->id_tipo_vehiculo}}" {{(old('tipo') == $item->id_tipo_vehiculo ? "selected" : "" )}}>{{ $item->nombre_tipo_vehiculo }}</option>
                          @endforeach
                 
                        </select>
                    </div>
                    <div class="form-group col-md-6" style="background-color: #FFF;" id="divFileAlta">
                      <label title="Seleccione las fotos del vehiculo, con un maximo de 6 fotos">Selecionar imagenes</label>
                      <input type="file" name="foto[]" id="foto" accept="image/*" multiple />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label title="Ingrese el Kilometraje que posee el vehiculo">Kilometraje</label>
                        <input type="number" name="kilometraje" id="id_kilometraje_editar"  autocomplete="off" id="id_kilometraje_modificacion" placeholder="Ingrese el Kilometraje que posee el vehiculo" class="form-control" value="{{ old('kilometraje') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label title="Ingrese el Kilometraje que posee el vehiculo">PDF Oficio Judicial </label>
                        <input type="file" name="nota-decreto" autocomplete="off"  value="{{ old('nota-decreto') }}">
                    </div> 
                  </div>



                  <div class="form-group col-md-12">
                      <label title="Observaciones del vehiculo, ejemplo, vehiculo dañado porque chocaron a la salida de la concesionaria y se rompio el paragolpe">Observaciones</label>
                      <textarea type="text" name="otros" id="id_otros_editar" autocomplete="off" maxlength="150"  placeholder="Observaciones" class="form-control" value="{{ old('otros') }}"></textarea>
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


