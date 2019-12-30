
<div class="modal fade" id="idModalLocalidadAlta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-md-12">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Agregar Municipio</h4>
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
                <form action="{{ route('crearMunicipio') }}" class="form-group" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                        <label>Nombre Municipio</label>
                        <input type="text" name="nombre_municipio" autocomplete="off"placeholder="Nombre de municipio" required class="form-control md-2" value="{{ old('nombre_municipio') }}"> 

                    </div>
                    <div class="form-group col-6">
                      <label>Nombre Departamento</label>
                      <input type="text" name="nombre_departamento" autocomplete="off"placeholder="Nombre de departamento" required class="form-control md-2" value="{{ old('nombre_departamento') }}"> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Poblacion</label>
                      <input type="number" name="poblacion" autocomplete="off" placeholder="Cantidad de población?" required class="form-control md-2" value="{{ old('poblacion') }}"> 
                    </div>
                  <div class="form-group col-6">
                      <label>Zona</label>
                      <input type="text" name="zona" maxlength="6" autocomplete="off" placeholder="En que zona se encuentra? Ej: Centro" required class="form-control md-2" value="{{ old('zona') }}"> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-3">
                      <label>Mujeres</label>
                      <input type="number" name="mujeres" autocomplete="off" placeholder="Cant. de mujeres?" required class="form-control md-2" value="{{ old('mujeres') }}"> 
                    </div>
                    <div class="form-group col-3">
                      <label>Varones</label>
                      <input type="number" name="varones" autocomplete="off" placeholder="Cant. de varones?" required class="form-control md-2" value="{{ old('varones') }}"> 
                    </div>
                    <div class="form-group col-6">
                      <label>Unidad regional</label>
                      <input type="text" name="unidad_regional" maxlength="4" autocomplete="off" placeholder="A que unidad regional pertenece? Ej: VII" required class="form-control md-2" value="{{ old('unidad_regional') }}"> 
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


