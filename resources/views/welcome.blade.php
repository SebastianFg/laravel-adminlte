@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      
    @if(strpos(Auth::User()->roles,'Suspendido'))
      <div class="row ">
        <div class="card col-sm-12">
          <div class="card-body">
            <h4 class="card-title">Su usuario se encuentra suspendido, contacte con un administrador</h4> 
            <br>
          </div>
        </div>
      </div>
    @else
    @if(strpos(Auth::User()->roles,'Sin Rol'))
      <div class="row">
        <div class="card col-sm-12">
          <div class="card-body">
            <h4 class="card-title">Su usuario no posee permisos, contacte con un administrador</h4> 
            <br>
          </div>
        </div>
      </div>
    @else
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Inicio</u></strong>
                </div>

                <div class="card-body">
                  <div class="row">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">

                        <div class="form-group busqueda ">
                          <input type="text" name="vehiculoBuscado" class="form-control" placeholder="numero de identificacion">
                        </div>
                       <div class="form-group busqueda ">
                          <select  id="id_marca" name="marcas" class="form-control ">
                            <option value="" selected="">Seleccione una marca</option>
                            @foreach ($marca as $item)
                              <option value="{{ $item->marca }}">{{ $item->marca }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group busqueda" >
                          <select name="anio" id="id_anio"  class="form-control ">
                            <option value="" selected="">Seleccione un año</option>
                            @foreach ($anios as $item)
                              <option value="{{ $item->anio_de_produccion }}">{{ $item->anio_de_produccion }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group busqueda">
                          <select name="id_tipo_vehiculo_lista"  class="form-control">
                            <option value="" selected="">Seleccione un tipo de vehiculo</option>
                            @foreach ($tipo_vehiculo as $item)
                              <option value="{{ $item->id_tipo_vehiculo }}">{{ $item->nombre_tipo_vehiculo }}</option>
                            @endforeach
                          </select>
                        </div>
                         
                      </div>
                        <div class="form-group busqueda">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar </i></button> 
                             <button class="btn btn-warning col-md-2 d-inline" style="padding: 5px;" id="limpiar"> <i class="fa fa-paint-brush"> Limpiar</i> </button>
                        </div>
                    </form>
                  </div>
                  <div class="row">
                    @if(isset($vehiculoBuscado))
                        <table tableStyle="width:auto" id="tablaResultado" class="table table-striped table-hover table-sm table-condensed table-bordered">
                          <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Año</th>
                                <th>Dominio</th>
                                <th>Motor</th>
                                <th>Chasis</th>
                                <th>N de identificacion</th>
                                <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                                @foreach($vehiculoBuscado as $item)
                            
                                  <tr>
                                    <td>{{ $item->marca }}</td>
                                    <td>{{ $item->anio_de_produccion }}</td>
                                    <td>{{ $item->dominio }}</td>
                                    <td>{{ $item->motor }}</td>
                                    <td>{{ $item->chasis }}</td>
                                    <td>{{ $item->numero_de_identificacion }}</td>
                                   
                                    <td>
                                      @can('vehiculos.informacion')
                                        <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                                      @endcan
                                    </td>
                                  
                                  </tr>
                                @endforeach
                            @else
                                <div class="row col-md-12">
                                  <div class="card col-md-12">
                                    <div class="card-body">
                                      <h4 class="card-title">Ingrese algun numero de identificacion o dominio del vehiculo</h4> 
                                      <br>
                                    </div>
                                  </div>
                                </div>
                          </tbody>
                        </table>
                    @endif

{{--                       <div class="row">
                          {{ $VehiculosListados->appends(Request::all())->links() }}
                      </div> --}}
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
      @endif
    @endif
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

    $('#limpiar').click(function() {
      $("#tablaResultado tr").remove(); 
      $("#id_afectado").empty();
      $('#id_afectado').val('');
      $('#id_anio').val('');
      $('#id_marca').val('');
      $('#id_dominio').val('');
      $('#id_identificacion').val('');
    });

</script>
@stop
<style type="text/css">
    .busqueda{
        padding: 5px;
    }
</style>