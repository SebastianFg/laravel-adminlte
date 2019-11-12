@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- /.content-header -->
{{--   {{Auth::User()->roles[1]->name  }} --}}
    <!-- Main content -->
    
    <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else


    @role('Admin')
      <div class="container-fluid">
        <div class="row" style="padding-top: 5px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3">
                    @role('Admin')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#miModal"> <i class="fa fa-plus"> Nuevo Usuario</i> </button> 
                    @endrole
                    <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>  
                  </div>

  {{--                 <div class="col-md-3">
                    <button type="button" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar</i>  </button> 
                    <button type="button" id="btnLimpiar" class="btn btn-warning left"> <i class="fa fa-paint-brush"> Limpiar</i> </button> 
                  </div> --}}
            </div>

            {{-- extiendo los modales --}}
            @extends('usuarios/modales/modal_asignar_rol')
            @extends('usuarios/modales/modal_baja_usuario')
             </div>

              </div>

                <hr>
                <div class="card">
                  <div class="card-header">
                    <strong><u>Lista de usuario</u></strong>
                  </div>
                

                  <div class="card-body">
                    <div class="row" >
                      <form class="navbar-form navbar-right pull-right" role="search">
                        <div class="row">
                          
                          <div class="form-group">
                            <input type="text"  name="usuarioBuscado" class="form-control" placeholder="Nombre, apellido o usuario">
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

                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Rol</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $item)
                        
                          <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->usuario }}</td>
                            <td> 
                              @if(!empty($item->getRoleNames()))
                                @foreach($item->getRoleNames() as $v)
                                   <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                              @endif
                            </td>
                           
                            <td>
                              @role('Admin')
                                <button  data-toggle="modal" onclick="agregarRol({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                            
                              @endrole
                               @can('usuarios.eliminarUsuario') <button  onclick="eliminarUsuario({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                               @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    @if($existe)
                      <div class="row">
                          {{ $usuarios->appends(Request::all())->links() }}
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
    @else
      {{ Auth::User()->roles[0]->name}}
    @endrole
    @endif
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

  function agregarRol(item){
    var rol_id = $('#role_id').val(null);
    var usuario = $('#usuario_id').val(item.id),
        nombre_apellido = $('#apellidoynombre_id').val(item.nombre),
        usuario_nombre = $('#nombre_usuario_id').val(item.usuario);

        $.each(item['roles'], function(i,e){
          $("#role_id option[value="+e.id+"]").prop("selected",true);
        }); 
    $('#modalAsignarRoles').modal('show');
  }
  function eliminarUsuario(item){
    console.log(item)
    var id_usuario_baja = $('#id_usuario_baja').val(item.id),
        apellido_nombre = $('#id_nombre_apellido').val(item.nombre),
        usuario_movimiento = $('#id_nombre_usuario').val(item.usuario);
    $('#modalBajaUsuario').modal('show');
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
}
</style>