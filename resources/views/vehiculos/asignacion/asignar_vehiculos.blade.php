@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <title>@yield('titulo', 'Patrimonio') | Jefatura</title>
  <!-- /.content-header -->


  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('vehiculos.asignarNuevo')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAsignacion"> <i class="fa fa-plus"> Nueva</i> </button> 
                  @endcan
                </div>
          </div>

          {{-- extiendo los modales --}}
          @extends('vehiculos/asignacion/modales/modal_asignacion_vehiculo')
          @extends('vehiculos/asignacion/modales/modal_eliminar_vehiculo_asignado')

           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Vehiculos Asignados</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="numero de identificacion">
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

                          <th>N de identificación</th>
                          <th>N de inventario</th>
                          <th>Dominio</th>
                          <th>Afectado</th>
                          <th>Fecha</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($asignacion as $item)
                        
                          <tr>
                            <td>{{ $item->numero_de_identificacion }}</td>
                            <td>{{ $item->numero_de_inventario }}</td>
                            <td>{{ $item->dominio }}</td>
                            <td>{{ $item->nombre_dependencia }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->fecha)) }}</td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->modelo }}</td>
                           
                            <td>
                              @can('vehiculos.informacion')
                                <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                              @endcan
                              @can('vehiculos.asignarEliminar') 
                                <button  onclick="eliminarAsignacion('{{ $item->id_vehiculo }}','{{ $item->numero_de_identificacion }}','{{ $item->dominio }}','{{ $item->id_detalle }}','{{ $item->nombre_dependencia }}','{{ $item->id_dependencia }}');" title="Eliminar asignacion"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                              @can('vehiculos.descargarPDFCargo') 
                                <a title="Descargar PDF Cargo" href="{{ route('pdfVehiculosCargo',$item->id_detalle) }}" class=" btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i></a>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="row">
                        {{ $asignacion->appends(Request::all())->links() }}
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

{{-- select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 

<script type="text/javascript">
  function eliminarAsignacion(id_vehiculo,numero_de_identificacion,dominio,id_detalle,nombre_dependencia,id_dependencia){
    cadena = 'Dominio: '+dominio+' Identificacion: '+numero_de_identificacion;

    var id_detalle = $('#id_detalle_asignacion').val(id_detalle),
        identificacion_vehiculo = $('#id_nombre_vehiculo_eliminado').val(cadena),
        id_vehiculo = $('#id_identificacion_vehiculo_eliminado').val(id_vehiculo),
        id_dependencia = $('#id_nombre_afectado_eliminado').val(nombre_dependencia),
        dependencia = $('#id_afectado_eliminado').val(id_dependencia);

    $('#idModalAsignacionBorrado').modal('show');
  }

</script>
<script type="text/javascript">

  $("#id_vehiculo").select2({
    dropdownParent: $("#select"),
    placeholder:"Ingrese numero de identificacion - Ej: 3-730",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllVehiculosDisponibles") }}',
      delay: 250,
      data: function (params) {

       /* console.log(params)*/
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        return {
            results:  $.map(data, function (item) {
                return {
                    text: item.dominio+' - N Identificacion '+item.numero_de_identificacion,
                    id: item.id_vehiculo,
                }
            })
        };
    },
    cache: true,

      },
  });

  $("#id_afectado").select2({
    dropdownParent: $("#select"),
    placeholder:"Seleccione Afectado - Ej: Jefatura,D.G Seguridad",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllAfectadosDisponibles") }}',
      delay: 250,
      data: function (params) {

        console.log(params)
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        console.log(data)
        return {
            results:  $.map(data, function (item) {
                return {
                    text: item.nombre_dependencia,
                    id: item.id_dependencia,
                }
            })
        };
    },
    cache: true,

      },
  });
</script>
@stop
