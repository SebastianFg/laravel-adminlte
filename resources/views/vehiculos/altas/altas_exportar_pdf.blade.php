<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>

</head>

<body  class="{{ isset($detalle_asignacion_vehiculo[0]->nombre_tipo_vehiculo) ? '' : 'noVehiculo' }}">


<div class="panel panel-success col-md-12 "  >
	<div class="header">
		<div class="col-md-12" style=" display: block;"  >
			<div class="col-md-3 "  style="float:left; position: relative;" >
				<img src="images/pdf_images/logosp.png">
			</div>
			<br>
			<div class="col-md-3 " style="float:center; text-align: center;">
				
				<p> <h4>DIRECCION GENERAL ADMINISTRACION</h4>
					<h4>DIRECCION PATRIMONIO</h4>
					<h4>DEPARTAMENTO AUTOMOTORES</h4>
				</p>
			</div>
		</div>
	</div>

	<div class=" panel panel-body " style=" display: block; margin-top: 120px;">
		<hr>
		<div class="col-md-12" style="float:center; text-align: center;" >
			<p><h4>LISTA DE VEHICUOLOS | {{  $cantidad_total }}</h4> </p>
			<br>
		</div>
		<br>
		<hr>
		<div class="col-md-12 ">
			<table id="listada_de_vehiculos" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th colspan="1" width="25">N°</th>
					 	<th width="60">I. INTERNA </th>
						<th >AFECTADO </th>
						<th >MARCA </th>
						<th width="25">AÑO </th>
						<th width="45">DOMINIO </th>
						<th >MOTOR </th>
						<th>CHASIS</th>
						<th width="50">TIPO</th>
						<th >N° DE INVENTARIO </th>
					</tr>
				</thead>
				<tbody>
		 			@foreach ($detalle_asignacion_vehiculo as $key => $item)
		 				<tr>
		 					<td >{{ $key +1}}</td>
		        			<td >{{ $item->numero_de_identificacion  }}</td>
		        			<td >{{ $item->nombre_dependencia  }}</td>
		        			<td >{{ $item->marca  }}</td>
		        			<td class="automatico">{{ $item->anio_de_produccion  }}</td>
		        			<td class="automatico">{{ $item->dominio  }}</td>
		        			<td >{{ $item->motor  }}</td>
		        			<td >{{ $item->chasis  }}</td>
		        			<td >{{ $item->nombre_tipo_vehiculo  }}</td>
					        <td class="automatico">{{ $item->numero_de_inventario  }}</td>
				      	</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>



<style type="text/css">

	.noVehiculo {
	  background-image: url('/images/fondo_pdf/fondo_pdf_x.jpg');
	  background-position: center;
	  background-repeat: no-repeat;
	}
	table{
		width: 100% !important; 
	}
	th {
		font-size: 12px;     
		font-weight: normal;     
		padding: 4px; 
		background: #B4B3A9;
	    color: #000000; 
	}

	td {    
		padding: 3px;     
		background: #E3E3E3; 
		width: 100%;
		border-bottom: 0.2px solid #fff;
	    color: #000000;   
	    border-top: 1px solid transparent; 
	}
	td.automatico{
		width:auto ;
	}

	.texto{
		text-decoration: underline black !important;
	}
	.parrafos{
		font-family: Vegur, 'PT Sans', Verdana, sans-serif;
	}
	.fondoDetalle{
		text-align: center; border-collapse: separate;background:
		radial-gradient(black 15%, transparent 16%) 0 0,
		radial-gradient(black 15%, transparent 16%) 8px 8px,
		radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
		radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
		background-size:16px 16px; 
		font-family: Vegur, 'PT Sans', Verdana, sans-serif; border-radius: 5px; 
	}

	#contenedor div{ float:left; }

	@page {
	  margin-top:  0px;
	  margin-right: 0px;
	  margin-left: 0px;
	}



</style>




</body>
</html>