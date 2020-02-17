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
        
                  <h5   style="text-decoration: underline;"class="d-flex justify-content-center">Departamento Automotores</h5>
                 
                </div>
              </div>
              <hr>
              <div class="row " style="padding-top: 5px;">
                <hr>
                <div class="card col-md-6">
                  <div class="card-header">
                    <h3 class="card-title">Vehículos Disponíbles</h3>
                    <div class="card-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body table-responsive">
                    <canvas id="vehiculosDisponibles"></canvas>
                    <div class="table-responsive ">
                      <hr>
                      <table class=" table table-striped table-sm table-hover table-condensed table-bordered">
                        <thead>
                          <tr>
                            <th>Tipo</th>
                            <th>Cantidades</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($total_vehiculos_disponibles as $item)
                            <tr>
                              <td>{{ $item->nombre_tipo_vehiculo }}</td>
                              <td>{{ $item->total_vehiculos }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="card col-md-6">
                  <div class="card-header">
                    <h3 class="card-title">Vehículos Disponibles</h3>
                    <div class="card-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="totalVehiculos"></canvas>
                    <div>
                      <hr>
                      <table class="table-sm table table-striped table-hover table-condensed table-bordered">
                        <thead>
                          <tr>
                            <th>Total de vehículos</th>
                            <th>Baja Total</th>
                            <th>En Reparación</th>
                            <th>Total de vehículos disponibles</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($total_vehiculos_reparacion as $item)
                            <tr>
                              <td>{{ $item->Total }}</td>
                              <td>{{ $item->totalbaja }}</td>
                              <td>{{ $item->totalreparacion }}</td>
                              <td>{{ $item->Total - ($item->totalreparacion+$item->totalbaja) }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <hr>
              <div class="row col-12">

                <form model="" class="navbar-form navbar-left pull-right" role="search">
                  <div class="row">

                    <div class="form-group busqueda ">
                      <input type="text" name="vehiculoBuscado" class="form-control" placeholder="Numero de identificación">
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
                        <option value="" selected="">Seleccione un tipo de vehículo</option>
                        @foreach ($tipo_vehiculo as $item)
                          <option value="{{ $item->id_tipo_vehiculo }}">{{ $item->nombre_tipo_vehiculo }}</option>
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
                       <button type="submit" id="btnBuscar" class="btn btn-info col-md-2 d-inline left"> <i class="fa fa-search-plus"> Buscar </i></button> 
                        <button class="btn btn-warning col-md-2 d-inline" style="padding: 5px;" id="limpiar"> <i class="fa fa-paint-brush"> Limpiar</i> </button>
                    </div>
                </form>
              </div>
                  <div class="row table-responsive ">

{{--                     @if(isset($vehiculoBuscado) || isset($dependencia_buscada)) --}}
                      @if(isset($vehiculoBuscado) && count($vehiculoBuscado)>0)
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
                          </tbody>
                        </table>
                      @elseif (isset($dependencia_buscada) && count($dependencia_buscada) > 0 )
                        <table tableStyle="width:auto" id="tablaResultadoUr" class="table table-striped table-hover table-sm table-condensed table-bordered">
                          <thead>
                            <tr>
                                <th>Dependencia</th>
                                <th>Cantidad de Vehiculos</th>
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
                                        <button class="btn btn-info btn-sm" onclick="detalleUnidadRegional({{$item->id_dependencia}});"><i class="fa fa-info"></i></button>
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
                              <h4 class="card-title">Ingrese algun número de identificación, dominio del vehículo, año o seleccione una dependencia para obtener una lista de los vehiculos</h4> 
                              <br>
                            </div>
                          </div>
                        </div>
                      @endif
                  </div>
                  <div class="col-md-12" id="modalopen"></div>
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
  {{-- vehiculos disponibles --}}
  var ctx = document.getElementById('vehiculosDisponibles').getContext('2d');
  var myChart = new Chart(ctx,{
    type:'doughnut',
    data:{
      labels: [
        @foreach($total_vehiculos_disponibles as $total)
          ['{{ $total->nombre_tipo_vehiculo }}'],
        @endforeach
      ],
      datasets:[{
        label:'Vehiculos disponibles',
        data:[
          @foreach($total_vehiculos_disponibles as $total)
            [{{ $total->total_vehiculos }}],
          @endforeach
        ],
        backgroundColor:[
          'rgb(235, 64, 52)',
          'rgb(33, 4, 2)',
          'rgb(46, 156, 3)',
          'rgb(183, 212, 171)',
          'rgb(191, 128, 189)',
          'rgb(148, 6, 143)',
          'rgb(209, 205, 209)',

          'rgb(85, 217, 184)',
          'rgb(245, 247, 247)',
          'rgb(201, 240, 72)',
          'rgb(245, 193, 241)',
          'rgb(135, 123, 134)',
        ],
        
      }]
    }
  });

  /*vehiculos en reparacion*/
  var ctx = document.getElementById('totalVehiculos').getContext('2d');
  var myChart = new Chart(ctx,{
    type:'doughnut',
    data:{
      labels: ['Baja total','En reparacion','Total de vehiculos disponibles'],
      datasets:[{
        label:'Vehiculos disponibles',
        data:[
          @foreach($total_vehiculos_reparacion as $item)
   
            [{{ $item->totalbaja }}],
            [{{ $item->totalreparacion }}],
            [{{ $item->Total - ($item->totalreparacion+$item->totalbaja) }}],
          @endforeach
        ],
        backgroundColor:[
          'rgb(252, 186, 3,0.5)',
          'rgb(212, 0, 0,0.5)',
          'rgb(229, 245, 56,0.5)',
          'rgb(46, 156, 3,0.5)',
        ],
        
      }]
    }
  });

  /*grafico de barras de siniestros*/
  /*var ctx= document.getElementById("graficoSiniestro").getContext("2d");
  var myChart= new Chart(ctx,{
      type:"line",
      
      data:{
        labels: [
          @foreach($total_siniestros as $total)
            ['{{ $total->anio }}'],
          @endforeach
        ],
        datasets:[{
                label:'Cantida de siniestros',
                pointStyle:'circle',
                showLine: true,
                steppedLine:false,
                borderJoinStyle:'miter',
                pointBackgroundColor:['rgb(0, 0, 0,0.5)'],
                pointBorderColor:['rgb(120, 120, 100,0.5)'],
                borderColor:[
                    'rgb(0, 0, 0,0.5)',
                ],
                data:[
                    @foreach($total_siniestros as $total)

                      ['{{ $total->totalsiniestro }}'],
                    @endforeach],
                backgroundColor:[
                    'rgb(66, 134, 244,0.5)',
                    'rgb(74, 135, 72,0.5)',
                    'rgb(229, 89, 50,0.5)'
                ],

                steppedLine:false,
          }]
      },
      options:{
          scales:{
              yAxes:[{
                      ticks:{
                          beginAtZero:true
                      }
              }]
          },

          chartOptions
      }
  });
  var chartOptions = {
    legend: {
      display: true,
      position: 'top',
      labels: {
        boxWidth: 80,
        fontColor: 'black'
      }
    }
  };*/
</script>

<script type="text/javascript">
  function filtroAnio() {

      var anio = $('#anio').val()

     $.ajax({
        url: '{{route('reportesListadoFiltro')}}',
        data:{
          "_token": $('meta[name="csrf-token"]').attr('content'),
          "anio" :anio,
        },
        type: "POST",
        success: function(r){
          console.log(r);
          
         $('#modalopen').html(r);
        
          
          
        }
        ,'error': function(data){
            console.log( 'oops', data );
        }
      });
  }
  function detalleUnidadRegional(id){
    console.log(id)
     var csrftoken = $('meta[name=csrf-token]').attr('content');

      $.ajax({
        type:"POST",
        url:'{{route('detalleUnidadRegional')}}',

        data:{'_token':csrftoken,'idDependencia':id},

        success: function(data){
          console.log(data)
          $('#modalopen').html(data);
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