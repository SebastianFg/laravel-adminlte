
	    <table id="listada_de_vehiculos_baja_definitiv_modal" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
	      <thead>
			<tr>     
		        <th>Fecha</th>
		        <th>Razon</th>
		        <th>Responsable</th>
			</tr>
	      </thead>
	    </table>


@extends('vehiculos/altas/script')

<script type="text/javascript">
	$(document).ready(function() {

      var table = $('#listada_de_vehiculos_baja_definitiv_modal').DataTable({
            "sdom": 'Blrtip',
            "bprocessing": true,
            "bserverSide": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [5, 25, 50, 75, 100],
            "bAutoWidth": false,
            "json":false,
           "ajax":{"url":"{{ url('/admin/detalleVehiculoIndividual',$id_vehiculo) }}"},
            "columns": [
                {data: 'estado_fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
                {data: 'estado_razon'},
                {data: 'name'},


               
            ],
            "language": Lenguaje_Español,
        });
      
    });

</script>