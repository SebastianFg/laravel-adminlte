@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <title>@yield('titulo', 'Patrimonio') | Jefatura</title>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">

          @extends('rolesPermisos/modales/modal_asignar_permiso_rol')


            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Lista de roles y Permisos</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12" >
                      <form class="navbar-form navbar-right pull-right" role="search">
                        <div class="row">
                          
                          <div class="form-group">
                            <input type="text" autocomplete="off"  name="RolPermisoBuscado" class="form-control" placeholder="ingrese permiso o rol">
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
                            <th>Permiso</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($lista_roles_permisos as $item)
                            <tr>
                              <td>{{ $item->name }}</td>
                              <td> 
  	                        	@foreach($item->roles as $key)
  	                           		@if($key->name == 'Super Admin'  and strpos(Auth::User()->roles,'Super Admin') == true )
  	                           		  <label class="badge badge-success">{{ $key->name }}</label>
                                  @endif
                                  @if($key->name != 'Super Admin' )
                                    <label class="badge badge-success">{{ $key->name }}</label>
                                  @endif
  	                           	@endforeach
                              </td>
                              <td>
                                @can('usuarios.asignarPermisosARoles')
                                  <button  data-toggle="modal" onclick="editar({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>                            
                                @endcan
                              </td>
                            
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @if($existe)
                        <div class="row">
                            {{ $lista_roles_permisos->appends(Request::all())->links() }}
                        </div>
                      @endif
                    </div>
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

  function editar(item){
    var rol_id = $('#role_id').val(null);
    var id_nombre_rol = $('#id_permiso').val(item.id),
        nombre_Rol = $('#id_permiso_rol_nombre').val(item.name);
        $.each(item['roles'], function(i,e){
          $("#role_id option[value="+e.id+"]").prop("selected",true);
        }); 
    $('#modalAsignarPermisosRoles').modal('show');
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