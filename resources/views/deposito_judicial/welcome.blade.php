@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
    <title>@yield('titulo', 'Patrimonio') | Inicio</title>
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
{{-- 
            <div class="card-header">
              <strong><u>Inicio</u></strong>
            </div>
 --}}
            <div class="card-body">
              <div class="row">
                
                <div class="col-2 card"> 
                  <img src="{{asset('images/pdf_images/logosp.png')}}">
                </div>
                <div class="card col-10">
                  <h1 style="text-decoration: underline;" class="d-flex justify-content-center"> Dirección General Administración</h1>
                 
                  <h3  style="text-decoration: underline;" class="d-flex justify-content-center">Dirección Patrimonio</h3>
        
                  <h5   style="text-decoration: underline;"class="d-flex justify-content-center">Deposito Judicial</h5>
                 
                </div>
              </div>
              <hr>
              <div class="row col-12">

                <form model="" class="navbar-form navbar-left pull-right" role="search">
                  <div class="row">

                    <div class="form-group busqueda ">
                      <input type="text" name="vehiculoBuscado" class="form-control" placeholder="Número de identificación">
                    </div>
                    <div class="form-group busqueda" >
                      <select name="anio" id="id_anio"  class="form-control ">
                        <option value="" selected="">Seleccione un año</option>
                        @foreach ($anios as $item)
                          <option value="{{ $item->anio_de_produccion_deposito_judicial }}">{{ $item->anio_de_produccion_deposito_judicial }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group busqueda col-md-4">
                      <select  id="id_juzgado_seleccionado" name="juzgado_seleccionado" class="form-control ">
                        <option value="" selected="">Seleccione Juzgado</option>
                        @foreach ($juzgados as $item)
                          <option value="{{ $item->id_juzgado }}">{{ $item->nombre_juzgado }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group busqueda ">
                      <select  id="id_dependencia_seleccionada" name="dependencia_seleccionada" class="form-control ">
                        <option value="" selected="">Seleccione una Unidad Regional</option>
                        @foreach ($dependencias as $item)
                          <option value="{{ $item->id_dependencia }}">{{ $item->nombre_dependencia }}</option>
                        @endforeach
                      </select>
        
                    </div>
                  </div>
                    <div class="form-group busqueda">
                       <button type="submit" id="btnBuscar" class="btn btn-info  d-inline left"> <i class="fa fa-search-plus"> Buscar </i></button> 
                        <button class="btn btn-warning  d-inline left" style="padding: 5px;" id="limpiar"> <i class="fa fa-paint-brush"> Limpiar</i> </button>
                    </div>
                </form>
              </div>
                  <div class="row table-responsive ">


                      @if(isset($vehiculoBuscado) && count($vehiculoBuscado)>0)
                        <table tableStyle="width:auto" id="tablaResultado" class="table table-striped table-hover table-sm table-condensed table-bordered">
                          <thead>
                            <tr>
                              <th>N° Ref</th>
                              <th>N° Identificación</th>
                              <th>Marca</th>
                              <th>Modelo</th>
                              <th>Dominio</th>
                              <th>N° de inventario</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($vehiculoBuscado as $item)
                              <tr>
                                <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                                <td>{{ $item->numero_de_identificacion_deposito_judicial }}</td>
                                
                                <td>{{ $item->marca_deposito_judicial }}</td>
                                <td>{{ $item->modelo_deposito_judicial }}</td>
                                <td>{{ $item->dominio_deposito_judicial }}</td>
                                <td>{{ $item->numero_de_inventario_deposito_judicial }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      @elseif (isset($dependencia_buscada) && count($dependencia_buscada) > 0 )
                        <table tableStyle="width:auto" id="tablaResultadoUr" class="table table-striped table-hover table-sm table-condensed table-bordered">
                          <thead>
                            <tr>
                                <th>Dependencia</th>
                                <th>Cantidad de Vehículos</th>
                                <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                                @foreach($dependencia_buscada as $item)
                            
                                  <tr>
                                    <td>{{ $item->nombre_dependencia }}</td>
                                    <td>{{ $item->cantidad_vehiculos }}</td>
                                   
                                    <td>
                                      @can('vehiculos.informacion')
                                        <button class="btn btn-info btn-sm" onclick="detalleUnidadRegionalDP({{$item->id_dependencia}});"><i class="fa fa-info"></i></button>
                                      @endcan
                                    </td>
                                  
                                  </tr>
                                @endforeach
                          </tbody>
                        </table>

                      @else
                        <div class="row col-md-12">
                          <div class="card col-md-12">
                            <div class="card-body">
                              <h4 class="card-title">Ingrese algun número de identificación, número de referencia aleatorio, dominio del vehículo o tambien puede seleccionar un año o una dependencia para obtener la lista de los vehículos del deposito judicial.</h4> 
                              <br>
                            </div>
                          </div>
                        </div>
                      @endif
                  </div>
                  <div class="col-md-12" id="modalopen"></div>
                  <div class="col-md-12" id="divVehiculo"></div>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

<script type="text/javascript">

    $('#limpiar').click(function() {
      $("#tablaResultado tr").remove(); 
      $("#tablaResultadoUr tr").remove();
      $("#modalopen").remove();
      $("#id_afectado").empty();
      $('#id_afectado').val('');
      $('#id_anio').val('');
      $('#id_marca').val('');
      $('#id_dependencia_seleccionada').val('');
      $('#id_dominio').val('');
      $('#id_identificacion').val('');
    });

</script>

<script type="text/javascript">

  function detalleUnidadRegionalDP(id){
    console.log(id)
     var csrftoken = $('meta[name=csrf-token]').attr('content');

      $.ajax({
        type:"POST",
        url:'{{route('detalleUnidadRegionalDP')}}',

        data:{'_token':csrftoken,'idDependencia':id},

        success: function(data){
          console.log(data)
          $('#modalopen').html(data);
        },error:function(data){
          console.log( 'Error al agregar el articulo', data );
        }
      });

  }
  function detalleUnidadRegionalVehiculoDP(id){
    console.log(id)
     var csrftoken = $('meta[name=csrf-token]').attr('content');

      $.ajax({
        type:"POST",
        url:'{{route('detalleUnidadRegionalVehiculoDP')}}',

        data:{'_token':csrftoken,'idDependencia':id},

        success: function(data){
          console.log(data)
          $('#divVehiculo').html(data);
        },error:function(data){
          console.log( 'Error al agregar el articulo', data );
        }
      });

  }
</script>


@stop
<style type="text/css">
    .busqueda{
        padding: 5px;
    }
  h2{
    text-decoration: underline;
  }
</style>