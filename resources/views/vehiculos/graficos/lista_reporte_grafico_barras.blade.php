@if(count($total_siniestros)>0)
  <div class="box box-danger col-md-12">
    <div class="box-body">
      <canvas id="graficoSiniestrofiltro"></canvas>
        <div>
          <hr>
          <table class="table-sm table table-striped table-hover table-condensed table-bordered">
            <thead>
              <tr>
                <th>Mes</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody>
              @foreach($total_siniestros as $item)
                <tr>
                  <td>{{ $item->mes }}</td>
                  <td>{{ $item->totalsiniestro }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
@else
  <p>No posee siniestros en el año seleccionado</p>
@endif



<script type="text/javascript">
  
  /*grafico de barras de siniestros*/
  var ctx= document.getElementById("graficoSiniestrofiltro").getContext("2d");
  var myChart= new Chart(ctx,{
      type:"bar",
      
      data:{
        labels: [
          @foreach($total_siniestros as $total)
            ['{{ $total->mes }}'],


            
          
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
  };
</script>