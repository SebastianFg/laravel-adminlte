@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Deposito Judicial</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('deposito.crear')
                  <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#modaAltaVehiculoDepositoJudicial"> <i class="fa fa-plus"> Nuevo vehículo DP</i> </button> 
                  @endcan
                </div>
              </div>
            </div>
          </div>
          {{-- modales --}}
          @extends('deposito_judicial.modales.modal_alta_vehiculo_deposito_judicial')
          @extends('deposito_judicial.modales.modal_editar_vehiculo_deposito_judicial')
          @extends('deposito_judicial.modales.modal_baja_vehiculo_deposito_judicial')

            <div class="card">
              <div class="card-header">
                <strong><u>Deposito Judicial</u></strong>
              </div>

              <div class="card-body">
                <div class="row col-md-12">
                  <form class="navbar-form navbar-right pull-right" role="search">
                    <div class="row">
                      <div class="form-group">
                        <input type="text" autocomplete="off"  name="vehiculoBuscado" class="form-control" placeholder="Ingrese número de ref.">
                      </div>
                      <div class="form-group">
                         <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                      </div>
                    </div>
                  </form>
                </div>
                <div class="row table-responsive" >
                  <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                    <thead>
                      <tr>
                        <th>N° Ref</th>
                        <th>N° Identificación</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Dominio</th>
                        <th>N° de inventario</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($vehiculosDepositoJudicial as $item)
                        <tr>
                          <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                          <td>{{ $item->numero_de_identificacion_deposito_judicial }}</td>
                          
                          <td>{{ $item->marca_deposito_judicial }}</td>
                          <td>{{ $item->modelo_deposito_judicial }}</td>
                          <td>{{ $item->dominio_deposito_judicial }}</td>
                          <td>{{ $item->numero_de_inventario_deposito_judicial }}</td>

                          <td>
                            @can('deposito.informacion') 
                             <a title="Información" class="btn btn-info btn-sm" href="{{ route('detalleVehiculoDP',$item->id_vehiculo_deposito_judicial) }}"><i class="fa fa-info"></i></a>
                            @endcan
                            @can('deposito.editar')
                              <button  data-toggle="modal" onclick="editarVehiculoJudicial({{$item }})" title="Editar Vehiculo" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                            @endcan
                            @can('deposito.eliminar') 
                              <button  onclick="eliminarVehiculo({{ $item }});" title="Eliminar vehículo"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            @endcan
                           
                          
                  
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div >
                      {{ $vehiculosDepositoJudicial->appends(Request::all())->links() }}
                  </div>
                </div>
              </div>
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
{{-- select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 
<script src="/dist/js/demo.js"></script>

<script type="text/javascript">
  $("#id_juzgado_alta").select2({
    dropdownParent: $("#select_deposito_judicial_vehiculo"),
    placeholder:"Seleccione juzgado",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllJuzgados") }}',
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
                    text: item.nombre_juzgado,
                    id: item.id_juzgado,
                }
            })
        };
    },
    cache: true,

      },
  });
  $("#id_juzgado_editar").select2({
    dropdownParent: $("#select_deposito_judicial_vehiculo_editar"),
    placeholder:"Seleccione juzgado",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllJuzgados") }}',
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
                    text: item.nombre_juzgado,
                    id: item.id_juzgado,
                }
            })
        };
    },
    cache: true,

      },
  });
</script>


<script type="text/javascript">

  function editarVehiculoJudicial(item){
    console.log(item)
    $('#id_vehiculo_deposito_judicial').val(item.id_vehiculo_deposito_judicial)
    $('#id_numero_de_identificacion_editar').val(item.numero_de_identificacion_deposito_judicial)
    $('#id_fecha_editar').val(item.fecha_deposito_judicial)
    $('#id_dominio_editar').val(item.dominio_deposito_judicial)
    $('#id_chasis_editar').val(item.chasis_deposito_judicial)
    $('#id_motor_editar').val(item.motor_deposito_judicial)
    $('#id_modelo_editar').val(item.modelo_deposito_judicial)
    $('#id_marca_editar').val(item.marca_deposito_judicial)
    $('#id_juzgado_editar').val(item.id_juzgado)

    $('#id_anio_produccion_editar').val(item.anio_de_produccion_deposito_judicial )
    $('#id_numero_de_inventario_editar').val(item.numero_de_inventario_deposito_judicial)
    $('#id_clase_de_unidad').val(item.clase_de_unidad_deposito_judicial)
    $('#id_tipo_editar').val(item.tipo_deposito_judicial)
    $('#id_otros_editar').val(item.otras_caracteristicas_deposito_judicial)
    $('#id_kilometraje_editar').val(item.kilometraje_deposito_judicial)
    $('#modaEditarVehiculoDepositoJudicial').modal('show');
  }
  function eliminarVehiculo(item){
    $('#id_vehiculo_baja_deposito_judicial').val(item.id_vehiculo_deposito_judicial)
    $('#id_vehiculo_baja_deposito_judicial_referencia').val(item.numero_de_referencia_aleatorio_deposito_judicial)

    $('#modalBajaVehiculoDepositoJudicial').modal('show');
  }

</script>

@stop

{{-- 
<script
  src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
