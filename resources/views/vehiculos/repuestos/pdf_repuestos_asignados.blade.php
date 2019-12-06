<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<div class="col-md-12" >
	<div class="header">
		<div class="col-md-12"style=" display: block;"  >
			<div class="col-md-3 "  style="float:left; position: relative;" >
				<img src="images/pdf_images/logosp.png">
			</div>
			<br>
			<div class="col-md-3 " style="float:center; text-align: center;">
				
				<p> <h4>DIRECCIÓN GENERAL ADMINISTRACIÓN</h4>
					<h4>DIRECCIÓN PATRIMONIO</h4>
					<h4>DEPARTAMENTO AUTOMOTORES</h4>
				</p>
			</div>
		</div>
	</div>

	<div class="container divbody" style="text-align: center;" >

		<div style="text-align: center;">
			<hr>
			<h2><strong>Repuestos</strong></h2>
		
			<div class="col-md-12 ">
				<div class="col-md-6" style="display: inline-block; ">
					<p  class="pdf_historial">Dominio:<strong class="encabezado_pdf_historial"> {{ $vehiculos_repuestos_asignados[0]->dominio }} </p>

					<p class="pdf_historial" >Numero de inventario:<strong class="encabezado_pdf_historial"> {{ $vehiculos_repuestos_asignados[0]->numero_de_inventario }} </p>
					<p class="pdf_historial" >Numero de identificación:<strong class="encabezado_pdf_historial"> {{ $vehiculos_repuestos_asignados[0]->numero_de_identificacion }} </p>
				</div>
				<hr>
			</div>
		</div>

		<div class="col-md-12 table-responsive " >
			<table   class=" table table-striped table-hover table-condensed table-bordered">
			    <thead>
			      <tr>
			        <th>Fecha</th>
			        <th>Responsable</th>
			        <th>Marca</th>
			        <th>Clase de unidad</th>
			      </tr>
			    </thead>
			    <tbody>
			    	@foreach($vehiculos_repuestos_asignados as $item)
				    	<tr>
				    		<td>{{ date('d-m-Y', strtotime($item->fecha)) }}</td>
				    		<td >{{ $item->usuario }}</td>
				    		<td >{{ $item->marca }}</td>
				    		<td >{{ $item->clase_de_unidad }}</td>
				    	</tr>
			    	@endforeach
			    </tbody>
			</table>
		</div>
		<hr>
		<div class="col-md-12">
			<br>
			<label><strong>Repuestos entregados:</strong></label>
			<p>{{ $vehiculos_repuestos_asignados[0]->repuestos_entregados }}</p>
		</div>
		<br>
		<br>
		<hr>
		<div class="col-md-12" >
			<div class="col-md-3" style="float:left;">
				<br>
				<strong>ENCARGADO DE ÁREA</strong>
				<br>
				.................................................
				<br>
				<strong>Aclaración:</strong>
				<br>
				.................................................
				<br>
				<strong>Jerarquia:</strong>
				<br>
				.................................................
			</div>
			<div class="col-md-3" style="float:right;">
				<br>
				<strong>RECIBE CONFORME</strong>
				<br>
				.................................................
				<br>
				<strong>Aclaración:</strong>
				<br>
				.................................................
				<br>
				<strong>Jerarquia:</strong>
				<br>
				.................................................
			</div>
		</div>

	</div>

</div>


<style type="text/css">

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
	p.pdf_historial {
    border: 1px;
    display: inline-block;
    width: auto;
    margin: 0 20px;
    text-align: justify;

  
}
	div.divbody{
		display: block; 
		margin-top: 120px;
	}
	h1.encabezado_pdf_historial{
		/*padding-top:0px;*/
		font-family: Vegur, 'PT Sans', Verdana, sans-serif;
	}

</style>

</body>
</html>