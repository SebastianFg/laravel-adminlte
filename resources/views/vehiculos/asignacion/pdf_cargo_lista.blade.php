<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>

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
				
				<p><h4>DIR. GENERAL ADMINISTRACIÓN</h4>
					<h4>DIRECCIÓN PATRIMONIO</h4>
					<h4>DEPARTAMENTO AUTOMOTORES</h4>
				</p>
			</div>

			<div class="col-md-3" style="float:right;position: fixed; margin-top: -30px;">
				<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('N. de identificación: '.$detalle_asignacion_vehiculo[0]->numero_de_identificacion.'-'.
                                        'Entregado por : '.$detalle_asignacion_vehiculo[0]->nombre.'-'.
                                        'Recibe : '.$detalle_asignacion_vehiculo[0]->nombre_dependencia.'-'.
                                        'Fecha : '.date('d-m-Y', strtotime($detalle_asignacion_vehiculo[0]->fecha)) .'-'.
                                        'clase de unidad : '.$detalle_asignacion_vehiculo[0]->clase_de_unidad.'-'.
                                        'marca : '.$detalle_asignacion_vehiculo[0]->marca.'-'.
                                        'chasis : '.$detalle_asignacion_vehiculo[0]->chasis.'-'.
                                        'motor : '.$detalle_asignacion_vehiculo[0]->motor.'-'.
                                        'año de produccion : '.$detalle_asignacion_vehiculo[0]->anio_produccion.'-'.
                                        'dominio : '.$detalle_asignacion_vehiculo[0]->dominio.'-'.
                                        'kilometraje : '.$detalle_asignacion_vehiculo[0]->kilometraje.'-'.
                                        'cubiertas : '.$detalle_asignacion_vehiculo[0]->neumaticos.'-'.
                                        'observaciones : '.$detalle_asignacion_vehiculo[0]->otras_caracteristicas.'-'.
                                        'Id Vehiculo : '.$detalle_asignacion_vehiculo[0]->idvehiculo.'-'.
                                        'http://127.0.0.1:8000/detalleVehiculo/'.$detalle_asignacion_vehiculo[0]->id_vehiculo)) !!} ">
			</div>
		</div>
	</div>

<div class="container" style=" display: block; margin-top: 120px;">
	<hr>
	<div style="text-align: center;">
		<h1>Cargo Automotor</h1>
	</div>
	<div class="col-md-12">
		<strong>Numero de identificación:</strong> <strong>{{ $detalle_asignacion_vehiculo[0]->numero_de_identificacion}}</strong>
		<br>
		<strong>Entregado por:</strong> {{ $detalle_asignacion_vehiculo[0]->nombre }}
		<br>
		<strong>Recibe:</strong> {{ $detalle_asignacion_vehiculo[0]->nombre_dependencia }}
		<br>
		<strong>Fecha:</strong> {{date('d-m-Y', strtotime($detalle_asignacion_vehiculo[0]->fecha))   }}
		<br>
		<strong>Clase de unidad:</strong> {{$detalle_asignacion_vehiculo[0]->clase_de_unidad  }}
		<br>
		<strong>Marca:</strong> {{$detalle_asignacion_vehiculo[0]->marca  }}
		<br>
		<strong>Chasis:</strong> {{$detalle_asignacion_vehiculo[0]->chasis  }}
		<br>
		<strong>Motor:</strong> {{$detalle_asignacion_vehiculo[0]->motor  }}
		<br>
		<strong>Año de producción:</strong> {{$detalle_asignacion_vehiculo[0]->anio_de_produccion  }}
		<br>
		<strong>Dominio:</strong> {{$detalle_asignacion_vehiculo[0]->dominio  }}
		<br>
		<strong>Kilometraje:</strong> {{$detalle_asignacion_vehiculo[0]->kilometraje  }} Km
		<br>
		<strong>Observaciones:</strong> {{$detalle_asignacion_vehiculo[0]->otras_caracteristicas  }}
		
		<hr>

		<br>
		<div class="col-md-3" style="float:left;">
			<br>
			<strong>PRESENTA LA UNIDAD</strong>
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
			<br>
			<strong>Fecha Hora:</strong>
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
			<br>
			<strong>Fecha Hora:</strong>
			<br>
			.................................................
		</div>


	</div>
	
</div>

</div>




<style type="text/css">
	
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
	/*	background-color:#282828;*/
		background-size:16px 16px; 
		font-family: Vegur, 'PT Sans', Verdana, sans-serif; border-radius: 5px; 
	}

#contenedor div{ float:left; }




</style>




</body>
</html>