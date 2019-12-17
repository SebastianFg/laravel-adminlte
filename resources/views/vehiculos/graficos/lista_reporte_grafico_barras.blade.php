@if(count($total_siniestros)>0)
  <div class="box box-danger col-md-12">
    <div class="box-body table-responsive">
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
  <p>El año seleccionado no posee siniestros</p>
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
                    'rgb(229, 89, 50,0.5)',
                    'rgb(74, 135, 72,0.5)',
                    'rgb(127, 136, 150,0.5)',
                    'rgb(25, 89, 184,0.5)',
                    'rgb(184, 25, 135,0.5)',
                    'rgb(161, 133, 152,0.5)',
                    'rgb(52, 155, 76,0.5)',
                    'rgb(155, 153, 52,0.5)',
                    'rgb(211, 162, 77,0.5)'

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