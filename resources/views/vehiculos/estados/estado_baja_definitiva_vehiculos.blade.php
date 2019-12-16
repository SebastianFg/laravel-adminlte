@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->
  <title>@yield('titulo', 'Patrimonio') | Jefatura</title>

  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">

          {{-- extiendo los modales --}}
          @extends('vehiculos/estados/modales/modal_alta_vehiculo_estado')
          @extends('vehiculos/estados/modales/modal_baja_total_vehiculos')

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Baja definitiva</u></strong>
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

                          <th>Numero de identificación</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Dominio</th>
                          <th>Estado</th>
                          <th>Fecha</th>
                          <th>Razon</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($estados_listado as $item)
                        
                          <tr>
                            <td><a href="{{ route('exportarPdfBajaDefinitiva',$item->estado_decreto) }}">{{ $item->numero_de_identificacion }}</a></td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->dominio }}</td>
                            @if( $item->tipo_estado_vehiculo == 1)
                               <td><label class="badge badge-warning">Fuera de servicio</label></td>
                            @elseif($item->tipo_estado_vehiculo == 2)
                              <td><label class="badge badge-danger">Baja total</label></td>
                            @endif

                            <td>{{ date('d-m-Y', strtotime($item->estado_fecha )) }}</td>
                            <td>{{ $item->estado_razon }}</td>
                           
                            <td>
                              @can('vehiculos.informacion')
                                <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                      <div class="row">
                          {{ $estados_listado->appends(Request::all())->links() }}
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
  function eliminarVehiculo(item){
    console.log(item)
    var dominio = $('#id_vehiculo_dominio_alta').val(item.dominio),
        id_vehiculo = $('#id_vehiculo_baja').val(item.id_vehiculo),
        estado = $('#id_vehiculo_estado').val(item.id_estado_vehiculo);

      $('#modalBajaDefinitivaVehiculo').modal('show');
  }

  function altaVehiculo(item){
    console.log(item)
    var dominio = $('#dominio_vehiculo_baja').val(item.dominio),
        id_vehiculo_alta = $('#id_vehiculo').val(item.id_vehiculo),
        estado = $('#id_vehiculo_estado').val(item.id_estado_vehiculo);

        $('#modalAltaVehiculoEstado').modal('show');
  }

</script>
@stop
