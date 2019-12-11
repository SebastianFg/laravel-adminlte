@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Jefatura</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->


  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      Su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      
      <div class="row col-md-12" style="padding-top: 5px;">
        <hr>
        <div class="card col-md-6">
          <div class="card-header">
            <h3 class="card-title">Vehiculos Disponibles</h3>
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
            <h3 class="card-title">Vehiculos Disponibles</h3>
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
                    <th>Total de vehiculos</th>
                    <th>Baja Total</th>
                    <th>En Reparación</th>
                    <th>Total de vehiculos disponibles</th>
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
      {{-- row --}}
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            
            <div class="card-header">
              <h3 class="card-title">Buscar graficas de siniestros por año</h3>
              <div class="card-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                @csrf
                <div class="input-group-prepend pull-left">
                  <span class="input-group-text fa fa-search" id="basic-addon1"></span>
                  <input type="number" id="anio" name="anio" class="form-control " placeholder="ingrese año" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <button class="submit btn btn-default col-md-2 d-inline" onclick="filtroAnio();">Buscar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            
            <div class="card-header">
              <h3 class="card-title">Grafica de siniestros</h3>
              <div class="card-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="panel panel-success" id="modalopen"></div>
            </div>
          </div>
        </div>
        
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

{{-- chart --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="/dist/js/demo.js"></script>

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
        url: '/admin/reportesFiltro',
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
          console.log('as');
            console.log( 'oops', data );
        }
      });
  }
</script>


@stop
