@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Repuestos</title>
<!-- Content Wrapper. Contains page content -->
  <meta charset="character_set">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
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
                  @can('vehiculos.crearRepuestos')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAsignacionRepuesto"> <i class="fa fa-plus"> Nuevo repuesto DP</i> </button> 
                  @endcan  
                </div>
              </div>

              {{-- extiendo los modales --}}
              @extends('deposito_judicial/repuestos/modales/modal_asignacion_repuestos')
              @extends('deposito_judicial/repuestos/modales/modal_editar_repuesto')
              @extends('vehiculos/modales/modal_detalle')
            </div>

          </div>
          <hr>
          <div class="card">
            <div class="card-header">
              <strong><u>Lista de repuestos</u></strong>
            </div>

            <div class="card-body">
              <form  role="search">
                <label class="col-3">N° ref.</label>
                <label class="col-3">Fecha Desde</label>
                <label class="col-3">Fecha Hasta</label>
                <div class="row">
                  <div class="form-group col-3">
                    <input type="text" name="vehiculoBuscado" autocomplete="off" class="form-control" placeholder="Número de identificación alet.">
                  </div>
                  <div class="form-group col-3">
                    <input type="date" name="fechaDesde" id="IdFechaDesde" autocomplete="off" class="form-control" placeholder="Ingrese una fecha">
                  </div>
                  <div class="form-group col-3">
                    <input type="date" name="fechaHasta" id="IdFechaHasta" autocomplete="off" class="form-control" placeholder="Ingrese una fecha">
                  </div>
                   
                </div>
                  <div class="form-group">
                     <button type="submit" id="btnBuscar" class="btn btn-info btn-sm left"> <i class="fa fa-search-plus"></i>Buscar  </button>
                      
                  </div>
              </form>
            </div>
              <hr>
            <div class="card-body">
              <div class="row table-responsive ">
                <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                  <thead>
                    <tr>

                      <th>Dominio</th>
                      <th>Fecha</th>
                      <th>Responsable</th>
                      <th>N. Ref</th>
                      <th>Marca</th>
                      <th>Clase de unidad</th>
                      <th>Repuestos</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($repuestos as $item)
                    
                      <tr>
                        <td>{{ $item->dominio_deposito_judicial }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->fecha_deposito_judicial )) }}</td>
                        <td>{{ $item->usuario }}</td>
                        <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                        <td>{{ $item->marca_deposito_judicial }}</td>
                        <td>{{ $item->clase_de_unidad_deposito_judicial }}</td>
                        
                   {{--      <td>{{ substr($item->repuestos_entregados_deposito_judicial ,0,10) }}...<a href="" onclick="detalle('{{ $item->repuestos_entregados_deposito_judicial }}')" data-toggle="modal" data-target="#modalDetalleRepuestos">ver mas</a> --}}
                         <td>{{ substr($item->repuestos_entregados_deposito_judicial,0,10) }}...<a href="#" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->repuestos_entregados_deposito_judicial)) !!}')" data-toggle="modal">ver mas</a></td>
                       
                        <td>
                          @can('vehiculos.informacion')
                            <a title="Información" class="btn btn-info btn-sm" href="{{ route('detalleVehiculoDP',$item->id_vehiculo_deposito_judicial) }}"><i class="fa fa-info"></i></a>
                          @endcan
                          @can('vehiculos.descargarPDFRepuesto') 
                            <a  title="Descargar PDF" href="{{ route('exportarPdfRepuestosDP',$item->id_detalle_repuesto_deposito_judicial) }}"  class="btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></a>
                          @endcan
                          @can('vehiculos.editarRepuesto')
                            <button title="Editar repuesto" type="button" class="btn btn-warning btn-sm" onclick="editarRepuesto({{$item}})"> <i class="fa fa-edit"></i> </button> 

                         {{--    <a  title="Descargar PDF" href="#"  class="btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></a> --}}
                          @endcan

                        </td>
                      
                      </tr>
                    @endforeach
                  </tbody>
                </table>
{{-- 
                <div class="row">
                    {{ $repuestos->appends(Request::all())->links() }}
                </div> --}}
               {{--  @if(isset($existe))
                @endif
  --}}
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
      url: '{{ route("getAllVehiculosDisponiblesRepuestosDP") }}',
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
                    text: item.dominio_deposito_judicial +' - N De Ref Aleatorio '+item.numero_de_referencia_aleatorio_deposito_judicial ,
                    id: item.id_vehiculo_deposito_judicial ,
                }
            })
        };
    },
    cache: true,

      },
  });


  function detalle(item){

    $('#idDetalle').html(item);
    $('#modalDetalleLugar').modal('show');
  }
  function editarRepuesto(item){
    $('#id_detalle_repuesto').val(item.id_detalle_repuesto_deposito_judicial)
    $('#id_repuestos_entregados_editar').val(item.repuestos_entregados_deposito_judicial);
    $('#modalEditarRepuesto').modal('show');
  }
</script>
@stop
