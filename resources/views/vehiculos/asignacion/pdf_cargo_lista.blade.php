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
				
				<p> <h4>DIRECCIÓN GENERAL ADMINISTRACIÓN</h4>
					<h4>DIRECCIÓN PATRIMONIO</h4>
					<h4>DEPARTAMENTO AUTOMOTORES</h4>
				</p>
			</div>

			<div class="col-md-3" style="float:right;position: fixed; margin-top: -30px;">
				<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('N. de identificación: '.$detalleVehiculo->numero_de_identificacion.'-'.
                                        'Entregado por : '.$nombre_responsable_entrega.'-'.
                                        'Recibe : '.$nombre_responsable_recibio.'-'.
                                        'Fecha : '.$detalleVehiculo->fecha.'-'.
                                        'clase de unidad : '.$detalleVehiculo->clase_de_unidad.'-'.
                                        'marca : '.$detalleVehiculo->marca.'-'.
                                        'chasis : '.$detalleVehiculo->chasis.'-'.
                                        'motor : '.$detalleVehiculo->motor.'-'.
                                        'año de produccion : '.$detalleVehiculo->anio_produccion.'-'.
                                        'dominio : '.$detalleVehiculo->dominio.'-'.
                                        'bateria : '.$detalleVehiculo->bateria.'-'.
                                        'kilometraje : '.$detalleVehiculo->kilometraje.'-'.
                                        'cubiertas : '.$detalleVehiculo->neumaticos.'-'.
                                        'observaciones : '.$detalleVehiculo->otras_caracteristicas.'-'.
                                        'Id Vehiculo : '.$detalleVehiculo->idvehiculo.'-'.
                                        'http://127.0.0.1:8000/detalleVehiculo/'.$detalleVehiculo->id_vehiculo)) !!} ">
			</div>
		</div>
	</div>

<div class="container" style=" display: block; margin-top: 120px;">
	<hr>
	<div style="text-align: center;">
		<h1>Cargo Automotor</h1>
	</div>
	<div class="col-md-12">
		<strong>Numero de identificación:</strong> <strong>{{ $detalleVehiculo->numero_de_identificacion}}</strong>
		<br>
		<strong>Entregado por:</strong> {{ $nombre_responsable_entrega }}
		<br>
		<strong>Recibe:</strong> {{ $nombre_responsable_recibio }}
		<br>
		<strong>Fecha:</strong> {{$detalleVehiculo->fecha  }}
		<br>
		<strong>Clase de unidad:</strong> {{$detalleVehiculo->clase_de_unidad  }}
		<br>
		<strong>Marca:</strong> {{$detalleVehiculo->marca  }}
		<br>
		<strong>Chasis:</strong> {{$detalleVehiculo->chasis  }}
		<br>
		<strong>Motor:</strong> {{$detalleVehiculo->motor  }}
		<br>
		<strong>Año de producción:</strong> {{$detalleVehiculo->anio_de_produccion  }}
		<br>
		<strong>Dominio:</strong> {{$detalleVehiculo->dominio  }}
		<br>
		<strong>Bateria:</strong> {{$detalleVehiculo->bateria  }}
		<br>
		<strong>Kilometraje:</strong> {{$detalleVehiculo->kilometraje  }}

		<br>
		{{-- <div style="text-align: center;"> --}}
			
			<strong>Cubiertas:</strong> {{$detalleVehiculo->otras_caracteristicas  }}
			<br>
			<strong>Observaciones:</strong> {{$detalleVehiculo->otras_caracteristicas  }}
	{{-- 	</div> --}}
		
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
			<strong>D.N.I</strong>
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
			<strong>D.N.I</strong>
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