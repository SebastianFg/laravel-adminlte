@extends('layouts.master')
<title>@yield('titulo', 'Patrimonio') | Jefatura</title>
{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

{{-- <link rel="stylesheet" href="{{ asset('css/modales.css') }}" /> --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->


  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      Su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('vehiculos.crear')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAltaTipoVehiculo"> <i class="fa fa-plus"> Nuevo</i> </button> 
                  @endcan
                  @can('vehiculos.imprimirLista')
                    <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>
                  @endcan  
                </div>

{{--                 <div class="col-md-3">
                  <button type="button" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar</i>  </button> 
                  <button type="button" id="btnLimpiar" class="btn btn-warning left"> <i class="fa fa-paint-brush"> Limpiar</i> </button> 
                </div> --}}
          </div>

          {{-- extiendo los modales --}}
          @extends('vehiculos/tipo_vehiculo/modales/modal_alta_tipo_vehiculo')
          @extends('vehiculos/tipo_vehiculo/modales/modal_editar_tipo_vehiculo')
          @extends('vehiculos/tipo_vehiculo/modales/modal_baja_tipo_vehiculo')
           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Vehiculos</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="tipoVehiculoBuscado" autocomplete="off" class="form-control" placeholder="tipo vehiculo">
                        </div>
                        <div class="form-group">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="row table-responsive ">
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                      <thead>
                        <tr>

                          <th>Tipo Vehiculo</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($tipo_vehiculo as $item)
                        
                          <tr>
                            <td>{{ $item->nombre_tipo_vehiculo }}</td>
                           
                            <td>
                              @can('vehiculos.editar') 
                                <button onclick="editarTipoVehiculo({{ $item }})" title="Editar vehiculo"   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                              @endcan
                              @can('vehiculos.eliminar') 
                                <button  onclick="eliminarTipoVehiculo({{ $item}});" title="Eliminar vehiculo"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                      <div class="row">
                          {{ $tipo_vehiculo->appends(Request::all())->links() }}
                      </div>
                   {{--  @if(isset($existe))
                    @endif
 --}}
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
  @endif
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
  function eliminarTipoVehiculo(item){

    var numero_de_identificacion = $('#id_nombre_tipo_vehiculo_baja').val(item.nombre_tipo_vehiculo);
    var id_vehiculo = $('#id_tipo_vehiculo_baja').val(item.id_tipo_vehiculo);

    $('#modalBajaTipoVehiculo').modal('show');
  }

  function editarTipoVehiculo(item){
    console.log(item)
    var nombre_tipo_vehiculo_editar = $('#id_nombre_tipo_vehiculo_editar').val(item.nombre_tipo_vehiculo),
        fecha = $('#id_tipo_vehiculo').val(item.id_tipo_vehiculo);

        $('#modalEdicionTipoVehiculo').modal('show');
  }

</script>
@stop
