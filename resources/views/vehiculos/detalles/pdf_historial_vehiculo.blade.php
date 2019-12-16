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

	<div class="container divbody">
		<div style="text-align: center;">
			<hr>
			<h2 ><strong>Historial del vehiculo</strong></h2>
		
		</div>
		<div class="col-md-12 padre">
				<p class="pdf_historial" >Dominio:<strong class="encabezado_pdf_historial"> {{ $historialCompletoAsignacion[0]->dominio }} </p>
				<p class="pdf_historial" >Numero de inventario:<strong class="encabezado_pdf_historial"> {{ $historialCompletoAsignacion[0]->numero_de_inventario }} </p>
				<p class="pdf_historial" >Numero de identificación:<strong class="encabezado_pdf_historial"> {{ $historialCompletoAsignacion[0]->numero_de_identificacion }} </p>
			<hr>
		</div>
		<div class="col-md-12 padre" >
			<table   class=" table table-striped table-hover table-condensed table-bordered">
			    <thead>
			      <tr >
			        <th>Historia</th>
			        <th>Fecha y hora</th>
			        <th>Responsable</th>
			      </tr>

			    </thead>
			    <tbody>
			    	@foreach($historialCompletoAsignacion as $historia)
				    	<tr>
				    		<td>{{ $historia->nombre_dependencia }}</td>
				    		<td>{{ date('d-m-Y', strtotime($historia->fecha)) }}</td>
				    		<td>{{ $historia->nombre }}</td>
				
				    	</tr>
			    	@endforeach
			    </tbody>
			</table>
		</div>
	</div>
</div>



<style type="text/css">
	.padre {
/*	  background-color: #fafafa;*/
	  margin: 1rem;
	  padding: 1rem;
	  /*border: 2px solid #ccc;*/
	  text-align: center;
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
</style>




</body>
</html>