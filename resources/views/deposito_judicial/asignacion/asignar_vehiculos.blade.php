@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<title>@yield('titulo', 'Patrimonio') | Asignación</title>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#modalAsignacionDepositoJudicial"> <i class="fa fa-plus"> Nueva asignación DP</i> </button> 
                  @endcan
                </div>
          </div>

          {{-- extiendo los modales --}}
          @extends('deposito_judicial/asignacion/modales/modal_asignacion_vehiculo')
          @extends('deposito_judicial/asignacion/modales/modal_eliminar_vehiculo_asignado')
          @extends('deposito_judicial/asignacion/modales/modal_edicion_asignacion_vehiculo_deposito_judicial')

           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u> Lista de vehículos asignados</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="Número de identificación">
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

                          <th>Nº de ref.</th>
                          <th>Nº de inventario</th>
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
                            <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                            <td>{{ $item->numero_de_inventario_deposito_judicial }}</td>
                            <td>{{ $item->dominio_deposito_judicial }}</td>
                            <td>{{ $item->nombre_dependencia }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->fecha)) }}</td>
                            <td>{{ $item->marca_deposito_judicial }}</td>
                            <td>{{ $item->modelo_deposito_judicial }}</td>
                           
                            <td>
                              @can('deposito.informacion')
                                <a title="Información" class="btn btn-info btn-sm" href="{{ route('detalleVehiculoDP',$item->id_vehiculo_deposito_judicial) }}"><i class="fa fa-info"></i></a>
                              @endcan
                              @can('deposito.editar') 
                                <button  onclick="editarAsignacion({{$item}});" title="Editar asignación"  class=" btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                              @endcan
                              @can('deposito.eliminar') 
                                <button  onclick="eliminarAsignacion({{$item}});" title="Eliminar asignación"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

           {{--          <div class="row">
                        {{ $asignacion->appends(Request::all())->links() }}
                    </div> --}}
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
  function eliminarAsignacion(item){

    console.log(item)
    $('#id_detalle_asignacion').val(item.id_detalle_deposito_judicial)
    $('#id_nombre_vehiculo_eliminado').val(item.numero_de_referencia_aleatorio_deposito_judicial)
    $('#id_nombre_afectado_eliminado').val(item.nombre_dependencia)

    $('#idModalAsignacionBorrado').modal('show');
  }
  function editarAsignacion(item){

    console.log(item)
    $('#id_detalle_asignacion_vehiculo').val(item.id_detalle_deposito_judicial)
    $('#id_vehiculo_deposito_judicial_edicion').val(item.id_vehiculo_deposito_judicial)
    $('#id_fecha_deposito_judicial_edicion').val(item.fecha)
    $('#id_afectado_edicion').val(item.id_dependencia)
    if (item.persona != null){
      $('#id_entidad_deposito_judicial_edicion').val(item.nombre_dependencia)
      $('#id_persona_deposito_judicial_edicion').val(item.nombre_dependencia)
    }
    $('#id_obs_deposito_judicial_edicion').val(item.observaciones)


    $('#modalEdicionAsignacionDepositoJudicial').modal('show');
  }
</script>


<script type="text/javascript">

  $("#id_vehiculo_deposito_judicial").select2({
    dropdownParent: $("#select_vehiculo"),
    placeholder:"Ingrese número de ref. aleatorio - Ej: DJ0001",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllVehiculosDisponiblesJudiciales") }}',
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
                    text: item.dominio_deposito_judicial+' - N ref. aleatoria '+item.numero_de_referencia_aleatorio_deposito_judicial,
                    id: item.id_vehiculo_deposito_judicial,
                }
            })
        };
    },
    cache: true,

      },
  });

  $("#id_afectado").select2({
    dropdownParent: $("#select_afectado"),
    placeholder:"Seleccione Afectado - Ej: Jefatura,D.G Seguridad",
    allowClear: true,
    minimumInputLength: 2,
    language: {
      noResults: function() {
        return "No hay resultado";        
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return 'Ingrese al menos 2 caracteres para comenzar a buscar';
      }
    },
    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllAfectadosDisponibles") }}',
      delay: 250,
      data: function (params) {
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        return {
            results:  $.map(data, function (item) {

              if (item.id_dependencia == 392){
                $('#mandatario_dignatario_deposito_judicial').show();

              }else{
                   $('#mandatario_dignatario_deposito_judicial').hide();
              }
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

  $("#id_vehiculo_deposito_judicial_edicion").select2({
    dropdownParent: $("#select_edicion_vehiculo"),
    placeholder:"Ingrese numero de identificacion - Ej: 3-730",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllVehiculosDisponiblesJudiciales") }}',
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
                    text: item.dominio_deposito_judicial+' - N ref. aleatoria '+item.numero_de_referencia_aleatorio_deposito_judicial,
                    id: item.id_vehiculo_deposito_judicial,
                }
            })
        };
    },
    cache: true,

      },
  });

  $("#id_afectado_edicion").select2({
    dropdownParent: $("#select_edicion_afectado"),
    placeholder:"Seleccione Afectado - Ej: Jefatura,D.G Seguridad",
    allowClear: true,
    minimumInputLength: 2,
    language: {
      noResults: function() {
        return "No hay resultado";        
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return 'Ingrese al menos 2 caracteres para comenzar a buscar';
      }
    },
    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllAfectadosDisponibles") }}',
      delay: 250,
      data: function (params) {
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        return {
            results:  $.map(data, function (item) {
              if (item.id_dependencia == 392){
                $('#mandatario_dignatario').show();
              }else{
                   $('#mandatario_dignatario').hide();
              }
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
