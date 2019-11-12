@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @role('Admin')
                  <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#miModalDependencia"> <i class="fa fa-plus"> Nueva dependencia</i> </button> 
                  @endrole
{{--                   <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>   --}}
                </div>

{{--                 <div class="col-md-3">
                  <button type="button" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar</i>  </button> 
                  <button type="button" id="btnLimpiar" class="btn btn-warning left"> <i class="fa fa-paint-brush"> Limpiar</i> </button> 
                </div> --}}
          </div>

          {{-- extiendo los modales --}}
          @extends('dependencias.modales.modal_alta_dependencia')
         {{--  @extends('rolesPermisos/permisos/modales/modal_edicion_permiso')
          @extends('rolesPermisos/permisos/modales/modal_baja_permiso') --}}
         
           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Lista de dependencias</u></strong>
                </div>

                <div class="card-body">
                  <div class="row " >
                      <form class="navbar-form navbar-right pull-right" role="search">
                        <div class="row cpl">
                          
                          <div class="form-group">
                            <input type="text"  name="nombreDependencia" class="form-control" placeholder="ingrese permiso">
                          </div>

                          <div class="form-group">
                            <select name="nivel_dependencia" class="form-control">
                              <option value="">Seleccione un tipo de dependencia</option>
                              <option value="3">Direccion General</option>
                              <option value="4">Direccion</option>
                              <option value="5">Departamento</option>
                              <option value="6">Division</option>
                              <option value="7">Seccion</option>
                            </select>
                          </div>
                          <div class="form-group">
                             <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                          </div>
                           
                        </div>
                      </form>
                    </div>
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                      <thead>
                        <tr>

                          <th>Dependencia</th>
                          <th>Padre</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dependencias as $item)
                        
                          <tr>
                            <td>{{ $item->hijo }}</td>
                            <td>{{ $item->padre }}</td>
                           
                            <td>
                              @role('Admin')
                                <button  data-toggle="modal" onclick="editarPermiso({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                               @can('usuarios.eliminarUsuario') <button  onclick="eliminarPermiso({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                               @endcan
                            
                              @endrole
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @if($existe)
                      <div class="row">
                          {{ $dependencias->appends(Request::all())->links() }}
                      </div>
                    @endif
                  </div>
                </div>
              </div>
                          </div>
          {{-- card --}}
          </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
  <!-- /.content -->
  </div>
  {{-- final --}}
</div>

@endsection

@section('javascript')
<!-- jQuery -->


<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

<script type="text/javascript">

  function editarPermiso(item){
    
    var id_nombre_rol = $('#id_permiso_edicion').val(item.id),
        nombre_Rol = $('#id_nombre_permiso_edicion').val(item.name);
    $('#idModalEdicion').modal('show');
  }
  function eliminarPermiso(item){
   // console.log(item)
    var id_nombre_rol = $('#id_permiso_baja').val(item.id),
        nombre_Rol = $('#id_nombre_permiso_baja').val(item.name);
    $('#idModalBaja').modal('show');
  }

</script>

@stop
<style type="text/css">
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}*/
.modal-body {
    position: relative;
    overflow-y: auto;
    max-height: 400px;
    padding: 15px;
}
</style>