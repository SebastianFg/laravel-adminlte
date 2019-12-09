
<div class="modal fade" id="modalEdicionVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Editar Vechiulo</h4>
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
                <form action="{{ url('admin/editar_vehiculo') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <input type="text" name="vehiculo" hidden="" id="id_vehiculo_modificacion" >
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nº de Identificación</label>
                        <input type="text" id="id_numero_de_identificacion_modificacion" name="numero_de_identificacion" autocomplete="off" maxlength="6" placeholder="Numero de identificacion" required class="form-control md-2" value="{{ old('numero_de_identificacion') }}"> 
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Fecha</label>
                      <input type="date"  id="id_fecha_modificacion"  name="fecha" class="form-control"  >
                    </div> 
                  </div>

                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Dominio</label>
                        <input type="text" name="dominio" autocomplete="off" id="id_dominio_modificacion" placeholder="Dominio: Ej-> AB123CD"  class="form-control" required value="{{ old('dominio') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Chasis</label>
                        <input type="text" name="chasis" autocomplete="off" id="id_chasis_modificacion" placeholder="Chasis" maxlength="20" class="form-control" required value="{{ old('chasis') }}">
                    </div> 
                  </div>
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Motor</label>
                        <input type="text" name="motor" autocomplete="off" id="id_motor_modificacion" placeholder="Motor" maxlength="20" class="form-control" required value="{{ old('motor') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Modelo</label>
                        <input type="text" name="modelo" autocomplete="off" id="id_modelo_modificacion" placeholder="Modelo" maxlength="20" class="form-control" required value="{{ old('modelo') }}">
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Marca</label>
                        <input type="text" name="marca" autocomplete="off" id="id_marca_modificacion" placeholder="Marca"  maxlength="20" class="form-control" required value="{{ old('marca') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Año de produccion</label>
                        <input type="number"  name="anio_produccion" autocomplete="off" id="id_anio_produccion_modificacion" placeholder="Año de Produccion" class="form-control" required value="{{ old('anio_produccion') }}">
                    </div> 
                  </div>
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Nº de inventario</label>
                        <input type="text" name="numero_de_inventario" autocomplete="off" id="id_numero_de_inventario_modificacion"  maxlength="15" placeholder="Numero de inventario: Ej-> 3000" class="form-control" required value="{{ old('numero_de_inventario') }}">
                    </div> 
                    <div class="form-group col-md-6">
                        <label for="">Clase de unidad</label>
                        <input type="text" name="clase_de_unidad" autocomplete="off" id="id_clase_de_unidad_modificacion" class="form-control" placeholder="clase de unidad" required value="{{ old('clase_de_unidad') }}">
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label for="">Tipo de vehiculo</label>
                        <br>  
                        <select name="tipo" id="id_tipo_modificacion" required="" class="form-control">
                        <option value="" selected="">Seleccione una vehiculo</option>
                          @foreach ($tipo_vehiculo as $item)
                            <option value="{{ $item->id_tipo_vehiculo }}">{{ $item->nombre_tipo_vehiculo }}</option>
                          @endforeach
                 
                        </select>
                    </div>
                      <div class="form-group col-md-6">
                        <label for="">Kilometraje</label>
                        <input type="number" name="kilometraje" autocomplete="off" id="id_kilometraje_modificacion" placeholder="Kilometraje" class="form-control" required value="{{ old('kilometraje') }}">
                    </div> 
                    <div class="form-group col-md-12">
                        <label for="">Observaciones</label>
                        <textarea type="text" name="otros" autocomplete="off" id="id_observaciones_modificacion" placeholder="Observaciones" class="form-control" required value="{{ old('otros') }}"></textarea>
                    </div>
                    <div class="form-group col-md-6" style="background-color: #FFF;" id="divFileEdit">
                        <label>Selecionar imagenes</label>
                        <input type="file" name="fotoEdit[]"  id="fotoEdit" accept="image/*" multiple />
                    </div>
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


