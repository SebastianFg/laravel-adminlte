
  <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Asignar Vehiculo</h4>
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
              <form action="{{ route('vehiculos.crearAsignacion') }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="form-group col-md-6">
                      <label>Seleccione Vehiculo</label>
                      <br>
                      <div id="select">
                          <select type="text" class="form-control" id="id_vehiculo" value="{{ old('vehiculo') }}" data-width="100%" name="vehiculo">
                          </select>
                      </div>
                  </div>
                   <div class="form-group col-md-6">
                      <label>Seleccione Afectado</label>
                      <br>
                      <div id="select">
                          <select type="text" class="form-control" id="id_afectado" onchange="getComboA(this)" data-width="100%" name="id_afectado">
                          </select>
                      </div>
                  </div>
                  <div class="col-md-12" id="div_mandatario1" style="display:none;">

                    <label>Ingrese mandatario o dignatario</label>
                    <br>
                    <input class="form-control" name="man_destinatario"  placeholder="Ingrese mandatario, dignatario o observacion de asignacion" >
  
                     <label >Ingrese ente</label>
                     <br>
                    <input class="form-control " name="ente_destinatario" placeholder="Ingrese nombre del ente" name="">
                  </div>

                  <div class="col-md-12" id="div_separacion1" style="display: block;"></div>
{{--                 <div class="form-group col-md-6">
                  <label>Entregado por</label>
                  <br>
                  <input type="text" name="entrego" readonly="" value="{{ Auth::User()->name }}" placeholder="Entregado por" required class="form-control ">
                </div> --}}
                   <input type="text" name="id_usuario" hidden="" value="{{ Auth::User()->id }}" placeholder="Entregado por" required class="form-control ">
                <div class="form-group col-md-6">
                    <label>Fecha</label>
                    <br>
                    <input type="date"  name="fecha" class="form-control " required >
                </div> 

                <div class="form-group col-md-12">
                    <label for="">Observaciones</label>
                    <textarea type="text" name="otros" placeholder="Observaciones" class="form-control" required></textarea>
                </div>

                <div class="col-md-12 modal-footer" style="position:relative;">
                    <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                  <a href="{{ route('asignarlistado') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                </div>            
              </form>
            </div>
        </div>
    </div>
  </div>
