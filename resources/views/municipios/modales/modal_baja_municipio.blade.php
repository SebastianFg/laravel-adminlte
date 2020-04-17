
  <div class="modal fade" id="idModalBajaMunicipio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content col-12">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Baja de municipio - localidad</h4>
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
        <div class="modal-body col-md-12">
          <form action="{{ route('eliminarMunicipio') }}" class="form-group" method="POST"enctype="multipart/form-data" >
              @csrf
              <div class="row">
                
                <div class="form-group col-12">
                  <label>Municipio</label>
                  <br>
                  <input type="text" readonly="" hidden="" id="id_municipio_baja" class="form-control" name="id_municipio" >
                  <input class="form-control" type="text" readonly="" autocomplete="off"  id="id_municipio_nombre" name="id_municipio_nombre" >
                </div>
              </div>
              <div class="col-md-12 modal-footer"style="position:relative;" >
                  <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a class="btn btn-danger col-md-4 d-inline" href="{{ route('indexMunicipios') }}">Cancelar</a> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



