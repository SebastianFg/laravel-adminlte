
<div class="modal fade" id="idModalEdicionMunicipio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Editar municipio - localidad</h4>
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
                <form action="{{ route('editarMunicipio') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                        <label>Nombre municipio</label>
                        <input type="text" name="nombre_municipio" id="id_nombre_municipio" autocomplete="off"placeholder="Nombre de municipio" required class="form-control md-2" value="{{ old('nombre_municipio') }}"> 
                        <input type="text" name="id_municipio" id="id_municipio" hidden="">
                    </div>
                    <div class="form-group col-6">
                      <label>Nombre departamento</label>
                      <input type="text" name="nombre_departamento" id="id_nombre_departamento" autocomplete="off"placeholder="Nombre de departamento" required class="form-control md-2" value="{{ old('nombre_departamento') }}"> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Población</label>
                      <input type="number" name="poblacion" id="id_poblacion_municipio" autocomplete="off" placeholder="Cantidad de población" required class="form-control md-2" value="{{ old('poblacion') }}"> 
                    </div>
                  <div class="form-group col-6">
                      <label>Zona</label>
                      <input type="text" name="zona" id="id_zona_municipio" maxlength="6" autocomplete="off" placeholder="En qué zona se encuentra Ej: Centro" required class="form-control md-2" value="{{ old('zona') }}"> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-3">
                      <label>Mujeres</label>
                      <input type="number" name="mujeres" autocomplete="off" id="id_mujeres_municipio" placeholder="Cant. de mujeres" required class="form-control md-2" value="{{ old('mujeres') }}"> 
                    </div>
                    <div class="form-group col-3">
                      <label>Varones</label>
                      <input type="number" name="varones" autocomplete="off" id="id_varones_municipio" placeholder="Cant. de varones" required class="form-control md-2" value="{{ old('varones') }}"> 
                    </div>
                    <div class="form-group col-6">
                      <label>Unidad regional</label>
                      <input type="text" name="unidad_regional" id="id_ur_municipio" maxlength="4" autocomplete="off" placeholder="A qué unidad regional pertenece Ej: VII" required class="form-control md-2" value="{{ old('unidad_regional') }}"> 
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


