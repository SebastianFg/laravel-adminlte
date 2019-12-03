
  <div class="modal fade centrado-porcentual" id="modalAsignarPermisosRoles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
            
        
        <div class="modal-dialog  vertical-align-center" role="document">
            <div class="modal-content col-md-5">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Asignar Permiso a un Rol</h4>
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
                <div class="modal-body  ">
                  <form action="{{ route('editarRolPermiso') }}" class="form-group" method="POST" enctype="multipart/form-data">
                   
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Permiso</label>
                            <input type="text" readonly="" autocomplete="off" name="permiso_nombre" id="id_permiso_rol_nombre"  required class="form-control md-2" value="{{ old('permiso_nombre') }}" autofocus> 
                            <input type="text"  id="id_permiso" hidden  name="id_permiso" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Seleccione Rol</label>  
                            <select name="role[]" id="role_id" required="" multiple="" class="form-control">
                              @foreach ($lista_roles as $item)
                                @if($item->name == 'Super Admin'  and strpos(Auth::User()->roles,'Super Admin') == true )
                                  <option value="{{ $item->id }}" id="id_rol_seleccionado">{{ $item->name }}</option>
                                @endif
                                @if($item->name != 'Super Admin' )
                                  <option value="{{ $item->id }}" id="id_rol_seleccionado">{{ $item->name }}</option>
                                @endif
                              @endforeach
                     
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 modal-footer" style="position:relative;">
                        <button class="btn btn-success col-md-4 d-inline" type="submit">Guardar</button>
                      <a href="{{ route('listaUsuarios') }}" class="col-md-4 d-inline btn btn-danger">Cancelar</a>
                    </div>            
                  </form>
                </div>
            </div>
        </div>
    </div>
  </div>