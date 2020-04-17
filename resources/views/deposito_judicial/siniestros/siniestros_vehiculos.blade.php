@extends('layouts.master')
<title>@yield('titulo', 'Patrimonio') | Siniestros Deposito Judicial</title>
{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
                  @can('vehiculos.altaSiniestro')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAltaSiniestro"> <i class="fa fa-plus"> Nuevo siniestro DP</i> </button> 
                  @endcan
                </div>
              </div>
            </div>
          </div>
          @extends('deposito_judicial/siniestros/modales/modal_alta_siniestro')
          @extends('deposito_judicial/siniestros/modales/modal_edicion_siniestro')
          @extends('vehiculos/modales/modal_detalle')
          <hr>
          <div class="card">
            <div class="card-header">
              <strong><u>Lista de  siniestros</u></strong>
            </div>
            <div class="card-body">
              <div class="row col-md-12">
                <form model="" class="navbar-form navbar-left pull-right" role="search">
                  <div class="row">
                    
                    <div class="form-group">
                      <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="Número de identificación">
                    </div>
{{--                         <div class="col-md-">
                      <select name="id_tipo_vehiculo_lista"  class="form-control">
                        <option value="" selected="">Seleccione un tipo de vehículo</option>
                        @foreach ($tipo_vehiculo as $item)
                          <option value="{{ $item->id_tipo_vehiculo }}">{{ $item->nombre_tipo_vehiculo }}</option>
                        @endforeach
                      </select>
                    </div> --}}
                    <div class="form-group">
                       <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                    </div>
                     
                  </div>
                </form>
              </div>
              <div class="row table-responsive ">
                <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered responsive">
                  <thead>
                    <tr>
                      <th>N° Ref.</th>
                      <th>Afectado</th>
                      <th width="8">Dirección</th>
                      <th>Fecha</th>
                      <th>Lesiones</th>
                      <th>Colisión</th>
                      <th>Presentación</th>
                      <th width="10">Observaciones</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($siniestros as $item)
                    
                      <tr>
                        @if($item->nombre_pdf_siniestro != null)
                          <td><a href="{{ route('descargarPDF',$item->nombre_pdf_siniestro) }}">{{ $item->numero_de_identificacion }}</a></td>
                        @else
                          <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                        @endif
                        
                        <td>{{ $item->nombre_dependencia }}</td>
          {{--               <td>{{ substr($item->lugar_siniestro_deposito_judicial ,0,10) }}...<a href="" onclick="detalle('{{ $item->lugar_siniestro_deposito_judicial }}')" data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                        </td> --}}
                        <td>{{ substr($item->lugar_siniestro_deposito_judicial,0,10) }}...<a href="#" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->lugar_siniestro_deposito_judicial)) !!}')" data-toggle="modal">ver mas</a></td>

                        <td>{{ date('d-m-Y', strtotime($item->fecha_siniestro_deposito_judicial)) }}</td>
                        @if($item->lesiones_siniestro_deposito_judicial == 1)
                          <td><label class="badge badge-danger">Si</label></td>
                        @else
                          <td><label class="badge badge-success">No</label></td>
                        @endif
                        <td>{{ substr($item->descripcion_siniestro_deposito_judicial,0,10) }}...<a href="" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->descripcion_siniestro_deposito_judicial)) !!}')"  data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                        </td>

                        <td>{{ date('d-m-Y', strtotime($item->fecha_presentacion_deposito_judicial)) }}</td>
                        <td>{{ substr($item->observaciones_siniestro_deposito_judicial,0,10) }}...<a href=""  onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->observaciones_siniestro_deposito_judicial)) !!}')" data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                        </td>
                        <td>
                          @can('vehiculos.informacion')
                            <a title="información" class="btn btn-info btn-sm" href="{{ route('detalleVehiculoDP',$item->id_vehiculo_deposito_judicial) }}"><i class="fa fa-info"></i></a>
                          @endcan
                          @can('vehiculos.editarSiniestro') 
                            <button onclick="editarSiniestro({{ $item }})" title="Editar siniestro"   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                          @endcan
              
{{--                               @can('vehiculos.eliminarSiniestro') 
                            <button  onclick="eliminarVehiculo('{{ $item->id_siniestro }}');" title="Eliminar vehiculo"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                          @endcan --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="row">
                    {{ $siniestros->appends(Request::all())->links() }}
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

{{-- select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 

<script type="text/javascript">
  $("#id_vehiculo").select2({
    dropdownParent: $("#select"),
    placeholder:"Seleccione Vehiculo",
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
      url: '{{ route("listaVehiculosSelectDepositoJudicial") }}',
      delay: 250,
      data: function (params) {

        console.log(params)
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        return {
            results:  $.map(data, function (item) {
                return {
                    text: item.dominio_deposito_judicial+' - N Identificacion '+item.numero_de_referencia_aleatorio_deposito_judicial,
                    id: item.id_vehiculo_deposito_judicial,
                }
            })
        };
    },
    cache: true,

      },
  });

  function editarSiniestro(item){
    console.log(item)
        $('#id_vehiculo_siniestro').val(item.id_vehiculo_deposito_judicial)
        $('#id_lesionados').val(item.lesiones_siniestro_deposito_judicial)
        $('#id_identificacion_interna').val(item.numero_de_identificacion_deposito_judicial)
        $('#id_fecha_siniestro').val(item.fecha_siniestro_deposito_judicial)
        $('#id_fecha_presentacion').val(item.fecha_presentacion_deposito_judicial)
        $('#id_lugar_siniestro').val(item.lugar_siniestro_deposito_judicial)
        $('#id_observaciones_siniestro').val(item.observaciones_siniestro_deposito_judicial)
        $('#id_descripcion_siniestro').val(item.descripcion_siniestro_deposito_judicial)
        $('#id_observaciones_siniestro').val(item.observaciones_siniestro_deposito_judicial)
        $('#id_siniestro').val(item.id_siniestro_deposito_judicial)
         
        $('#idModalEdicionSiniestro').modal('show');
  }

  function detalle(item){

    $('#idDetalle').html(item);
    $('#modalDetalleLugar').modal('show');
  }

</script>
@stop