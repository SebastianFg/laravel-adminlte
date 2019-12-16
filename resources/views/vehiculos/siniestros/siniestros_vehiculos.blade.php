@extends('layouts.master')
<title>@yield('titulo', 'Patrimonio') | Jefatura</title>
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
                  @can('vehiculos.crear')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAltaSiniestro"> <i class="fa fa-plus"> Nuevo</i> </button> 
                  @endcan
                  @can('vehiculos.imprimirLista')
                    <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>
                  @endcan  
                </div>
              </div>
            </div>
          </div>
          @extends('vehiculos/siniestros/modales/modal_alta_siniestro')
          @extends('vehiculos/siniestros/modales/modal_edicion_siniestro')
          @extends('vehiculos/modales/modal_detalle')
          <hr>
          <div class="card">
            <div class="card-header">
              <strong><u>Siniestros</u></strong>
            </div>
            <div class="card-body">
              <div class="row col-md-12">
                <form model="" class="navbar-form navbar-left pull-right" role="search">
                  <div class="row">
                    
                    <div class="form-group">
                      <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="numero de identificacion">
                    </div>
{{--                         <div class="col-md-">
                      <select name="id_tipo_vehiculo_lista"  class="form-control">
                        <option value="" selected="">Seleccione un tipo de vehiculo</option>
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
                      <th>N° Identificación</th>
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
                          <td>{{ $item->numero_de_identificacion }}</td>
                        @endif
                        
                        <td>{{ $item->nombre_dependencia }}</td>
                        <td>{{ substr($item->lugar_siniestro ,0,10) }}...<a href="" onclick="detalle('{{ $item->lugar_siniestro }}')" data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                        </td>

                        <td>{{ date('d-m-Y', strtotime($item->fecha_siniestro)) }}</td>
                        @if($item->lesiones_siniestro == 1)
                          <td><label class="badge badge-danger">Si</label></td>
                        @else
                          <td><label class="badge badge-success">No</label></td>
                        @endif
                        <td>{{ substr($item->descripcion_siniestro,0,10) }}...<a href="" onclick="detalle('{{ $item->descripcion_siniestro }}')" data-toggle="modal" data-target="#modalDetalleDesc">ver mas</a>
                        </td>

                        <td>{{ date('d-m-Y', strtotime($item->fecha_presentacion)) }}</td>
                        <td>{{ substr($item->observaciones_siniestro,0,10) }}...<a href="" onclick="detalle('{{ $item->observaciones_siniestro }}')" data-toggle="modal" data-target="#modalDetalleObs">ver mas</a>
                        </td>
                        <td>
                          @can('vehiculos.informacion')
                            <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
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

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("listaVehiculosSelect") }}',
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
                    text: item.dominio+' - N Identificacion '+item.numero_de_identificacion,
                    id: item.id_vehiculo,
                }
            })
        };
    },
    cache: true,

      },
  });

  function editarSiniestro(item){
    console.log(item)
        var id_vehiculo = $('#id_vehiculo_siniestro').val(item.id_vehiculo),
         lesiones_siniestro = $('#id_lesionados').val(item.lesiones_siniestro),
         identificacion = $('#id_identificacion_interna').val(item.numero_de_identificacion),
         fecha_siniestro = $('#id_fecha_siniestro').val(item.fecha_siniestro),
         fecha_presentacion = $('#id_fecha_presentacion').val(item.fecha_presentacion),
         lugar_siniestro = $('#id_lugar_siniestro').val(item.lugar_siniestro),
         observaciones = $('#id_observaciones_siniestro').val(item.observaciones_siniestro),
         descripcion_siniestro = $('#id_descripcion_siniestro').val(item.descripcion_siniestro),
         observaciones_siniestro = $('#id_observaciones_siniestro').val(item.observaciones_siniestro),
         siniestro_id = $('#id_siniestro').val(item.id_siniestro);
         
        $('#idModalEdicionSiniestro').modal('show');
  }

  function detalle(item){
    var asdasd = $('#idDetalle').val(item);
    $('#modalDetalleLugar').modal('show');
  }

</script>
@stop