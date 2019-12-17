@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Jefatura</title>
<!-- Content Wrapper. Contains page content -->
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
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAsignacionRepuesto"> <i class="fa fa-plus"> Nuevo</i> </button> 
                  @endcan  
                </div>
          </div>

          {{-- extiendo los modales --}}
          @extends('vehiculos/repuestos/modales/modal_asignacion_repuestos')
          @extends('vehiculos/modales/modal_detalle')

           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Repuestos</u></strong>
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

                          <th>Dominio</th>
                          <th>Fecha</th>
                          <th>Responsable</th>
                          <th>N de identificación</th>
                          <th>Marca</th>
                          <th>clase de unidad</th>
                          <th>Repuestos</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($repuestos as $item)
                        
                          <tr>
                            <td>{{ $item->dominio }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->fecha )) }}</td>
                            <td>{{ $item->usuario }}</td>
                            <td>{{ $item->numero_de_identificacion }}</td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->clase_de_unidad }}</td>
                            <td>{{ substr($item->repuestos_entregados ,0,10) }}...<a href="" onclick="detalle('{{ $item->repuestos_entregados }}')" data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                           
                            <td>
                              @can('vehiculos.informacion')
                                <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                              @endcan
                              @can('vehiculos.descargarPDFRepuesto') 
                                <a  title="Descargar PDF" href="{{ route('descargarPDFRepuesto',$item->id_detalle_repuesto) }}"  class="btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></a>
                              @endcan

                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="row">
                        {{ $repuestos->appends(Request::all())->links() }}
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
{{-- select 2 --}}
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
      url: '{{ route("getAllVehiculosDisponiblesRepuestos") }}',
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
  function detalle(item){
    var asdasd = $('#idDetalle').val(item);
    $('#modalDetalleLugar').modal('show');
  }
</script>
@stop
