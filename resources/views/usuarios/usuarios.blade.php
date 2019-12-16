@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Jefatura</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- /.content-header -->
{{--   {{Auth::User()->roles[1]->name  }} --}}
    <!-- Main content -->
    
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      <div class="row ">
        <div class="card col-sm-12">
          <div class="card-body">
            <h4 class="card-title">Su usuario se encuentra suspendido, contactese con un administrador!</h4> 
            <br>
          </div>
        </div>
      </div>
    @else
      <div class="container-fluid">
        <div class="row" style="padding-top: 5px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3-responsive">
                    @can('usuarios.crear')
                      <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#modalAltaUsuario"> <i class="fa fa-plus"> Nuevo Usuario</i> </button> 
                    @endcan
                  </div>
                </div>
                {{-- extiendo los modales --}}
                @extends('usuarios/modales/modal_asignar_rol')
                @extends('usuarios/modales/modal_baja_usuario')
                @extends('usuarios/modales/modal_nuevo_usuario')
                
              </div>

            </div>
            <hr>
            <div class="card">
              <div class="card-header">
                <strong><u>Lista de usuario</u></strong>
              </div>
              <div class="card-body">
                <div class="row col-md-12"  >
                  <form class="navbar-form navbar-right pull-right" role="search">
                    <div class="row">
                      <div class="form-group">
                        <input type="text" autocomplete="off" name="usuarioBuscado" class="form-control" placeholder="Nombre, apellido o usuario">
                      </div>
                      <div class="form-group">
                         <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                      </div>
                    </div>
                  </form>
                </div>
                <div class="row table-responsive">
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
                      @if(strpos(Auth::User()->roles,'Super Admin'))
                    
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
                              @if(strcmp($item->getRoleNames(),'Super Admin') != 0)
                                @can('usuarios.asignarRol')
                                  <button  data-toggle="modal" onclick="agregarRol({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                @endcan
                                @can('usuarios.eliminarUsuario') 
                                  <button  onclick="eliminarUsuario({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                @endcan
                                @can('usuarios.resetPassword')
                                  <a class="btn btn-secondary btn-sm" href="{{ route('resetPassword',$item->id) }}"><i class="fa fa-undo"></i></a>
                                @endcan
                              @endif
                            </td>
                          </tr>
               
                      @endif
                  
                        @if(strpos($item->getRoleNames(),'Super Admin') == false and strpos(Auth::User()->roles,'Super Admin') != true ) 
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
                              @if(strcmp($item->getRoleNames(),'Super Admin') != 0)
                                @can('usuarios.asignarRol')
                                  <button  data-toggle="modal" onclick="agregarRol({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                @endcan
                                @can('usuarios.eliminarUsuario') 
                                  <button  onclick="eliminarUsuario({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                @endcan
                                @can('usuarios.resetPassword')
                                  <a class="btn btn-secondary btn-sm" href="{{ route('resetPassword',$item->id) }}"><i class="fa fa-undo"></i></a>
                                @endcan
                              @endif
                            </td>
                          </tr>
                        @endif

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
        </div>
      </div>
    @endif
  </div>
</div>
@endsection

@section('javascript')

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