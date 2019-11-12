@extends('plantilla')

@section('seccion')

<div class="panel panel-success">
{{-- migajas --}}
{{-- 	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ url('alta_vehiculos_autobombas') }}">Vehiculos</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Detalles </li>
	  </ol>
	</nav> --}}
	<div class="panel panel-heading"><h3 style=" font-family: Vegur, 'PT Sans', Verdana, sans-serif; ">Detalles del vehiculo <strong>{{$detalleVehiculo->dominio  }}</strong></h3></div>
<div class="panel panel-body">
	{{-- <button class="btn btn-default"><a href="{{ url('vehiculos') }}"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a></button> --}}
	<div class=" col-md-12 panel panel-default fondoDetalle" >
		<div class="panel panel-danger col-md-6" style="text-align: left; border-collapse: separate;background-color:#FCFCFC;">
			<h1>Vehiculo</h1>
			<label class="texto" >Numero de identificacion</label>
			<p class="parrafos" >{{ $detalleVehiculo->numero_de_identificacion }}</p>

			<label class="texto">Clase de unidad</label>
			<p class="parrafos" >{{$detalleVehiculo->clase_de_unidad  }}</p>
			
			<label class="texto">Marca</label>
			<p class="parrafos" >{{$detalleVehiculo->marca  }}</p>
			
			<label class="texto">Modelo</label>
			<p class="parrafos" >{{$detalleVehiculo->modelo  }}</p>
			
			<label class="texto" >Chasis</label>
			<p class="parrafos" >{{$detalleVehiculo->chasis  }}</p>
			
			<label class="texto">Motor</label>
			<p class="parrafos" >{{$detalleVehiculo->motor  }}</p>
			
			<label class="texto">Año de produccion</label>
			<p class="parrafos" >{{$detalleVehiculo->anio_de_produccion  }}</p>
			
			<label class="texto">dominio </label>
			<p class="parrafos" >{{$detalleVehiculo->dominio  }}</p>

			<label class="texto">Bateria</label>
			<p class="parrafos" >{{$detalleVehiculo->bateria  }}</p>

			<label class="texto">Kilometraje</label>
			<p class="parrafos" >{{$detalleVehiculo->kilometraje  }}</p>

			<label  class="texto">Observaciones</label>
			@if($detalleVehiculo->otras_caracteristicas == null)
				<p class="parrafos">No posee obs.</p>
			@else
				<p class="parrafos" >{{$detalleVehiculo->otras_caracteristicas  }}</p>
			@endif

			<label class="texto">Fecha</label>
			<p class="parroafos">{{$detalleVehiculo->fecha  }}</p>

			
		</div>

		{{-- Modal --}}
		@extends('vehiculos/modales/modal_pdf_siniestro')
		<div class="panel panel-success" id="modalopen"></div>

		<div class="panel panel-danger col-md-6" style="background-color:#FCFCFC; text-align: left; border-collapse: separate;  ">
			<h1 style="text-align: left; border-collapse: separate; font-family: Vegur, 'PT Sans', Verdana, sans-serif; " >Responsable actual</h1>
			<label class="texto" >Entrego</label>

			<p class="parrafos">{{$nombre_responsable_entrega  }}</p>
			
			<label class="texto" >Recibio</label>
			<p class="parrafos">{{$nombre_responsable_recibio  }}</p>
		</div>
		<div class="panel panel-heading col-md-6">
			<h3>Historial del vehiculo</h3>
		</div>
		@if(isset($paginatedItems))
		<input type="" id="id_vehiculo" style="display: none;" value="{{ $detalleVehiculo->id_vehiculo }}" name="">
		<div class="panel panel-default col-md-6">

			<p style="font-weight:bold;"><a href="{{ route('pdfVehiculos',$detalleVehiculo->id_vehiculo) }}"><span class="glyphicon glyphicon-save"></span></a> Descargar pdf</p>

			  <table id="listada_de_vehiculos" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
			  	@csrf
			    <thead>
			      <tr>

			        <th>Destino</th>
			        <th>Fecha</th>
		
			      </tr>
			    </thead>
			    <tbody>
		 			@foreach ($paginatedItems as $item)
		 				<tr>
		        			<td>{{ $item->nombre_dependencia  }}</td>
					        <td>{{ $item->fecha  }}</td>
				      	</tr>
					@endforeach
			    </tbody>
			  </table>
			    <div class="row">
				    {{ $paginatedItems->links() }}
				</div>
		</div>
		@else
			<p>No posee historial</p>
		@endif
	</div>
	</div>
	<div class="panel panel-heading">Siniestros</div>
	<div class="panel panel-body col-md-12">

		
		<div class="panel panel-default col-md-12">
	      <table id="lista_vehiculos_siniestro" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
	        <thead>
	          <tr>
	            <th>N° Interno</th>
	            <th>Afectado</th>
	            <th>Lugar</th>
	            <th>Fecha</th>
	            <th>Lesiones</th>
	            <th>Colision</th>
	            <th>Presentacion</th>
	            <th>Observaciones</th>
	            <th>Acciones</th>
	          </tr>
	        </thead>
	      </table>
		</div>
		
	</div>
	<div class="panel panel-heading">Imagenes</div>
	<div class="panel panel-body col-md-12">
		
		<div class="col-md-12 "  >
			<div id="carousel-example-generic" class="carousel slide col-md-6 " data-ride="carousel">
			 
			  <ol class="carousel-indicators">
				   @foreach( $imagenes_vehiculo as $photo )
				      <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
				   @endforeach
			  </ol>
			 
			  <div class="carousel-inner" >
			    @foreach( $imagenes_vehiculo as $photo )
			       <div class="item {{ $loop->first ? 'active' : '' }}">
			           <img class="d-block img-fluid" src="../../images/{{ $photo->nombre_imagen }}" >

			       </div>
			    @endforeach
			  </div>
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>
	</div>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer ></script>




<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"defer></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"defer></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"defer></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 

<script>
   
    $(document).ready(function() {

      var table = $('#lista_vehiculos_siniestro').DataTable({
            "sdom": 'Blrtip',
           // "pageLength": 5,
          /*  "bSort": true,*/
            "bprocessing": true,
            "bserverSide": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
         /*   "ordering": true,*/
            "bInfo": true,
            "lengthMenu": [5, 25, 50, 75, 100],
            "bAutoWidth": false,
    /*        "lengthMenu": [[5,10,100,-1],["5","10","100","Todos"]],*/
            "json":false,
            "ajax":{"url":"{{ url('admin/detalle_Datatable',$detalleVehiculo->id_vehiculo) }}"},
            "columns": [
                {data: 'numero_de_identificacion'},
                {data: 'afectado_siniestro'},
                {data: 'lugar_siniestro'},
                {data: 'fecha_siniestro'},
                {data: 'lesiones_siniestro',
                "render": function (data, type, row) {
                  if ({data:"lesiones_siniestro"} == '0') {
                    return 'Si';
                  }else {
                    return 'No'
                  }
                    }
              },
                {data: 'descripcion_siniestro'},
                {data: 'fecha_presentacion'},
                {data: 'observaciones_siniestro'},
                 {"defaultContent": '<button data-toggle="modal" title="Descargar PDF"  class="Descargarbtn btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></button>'},
            ],
            "language": Lenguaje_Español,
        });

        descargar_pdf("#lista_vehiculos_siniestro",table);
    });

  

    function descargar_pdf(tbody,table) {
     $(tbody).on("click","button.Descargarbtn",function(){
        var data = table.row($(this).parents("tr")).data();
       

       $.ajax({
          url: '/admin/detalle_pdf_siniestro',
          data:{

            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id_siniestro" :data.id_siniestro,
          },
          type: "POST",
          success: function(r){
           $("#miModalPdfSiniestro").modal('show');
            $('#modalopen').html(r);
          },
          'error': function(data){
            $("#miModalPdfSiniestro").modal('hide');
            swal("Error!!", "no hay pdfs para descargar", "error");
          }
        });
      }); 
    }

    var Lenguaje_Español = {
                "emptyTable":     "No hay datos disponibles en la tabla.",
                "info":           "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":      "Mostrando 0 registros de un total de 0.",
                "infoFiltered":     "(filtrados de un total de _MAX_ registros)",
                "infoPostFix":      "(actualizados)",
                "lengthMenu":     "Cantidad de registros _MENU_",
                "loadingRecords":   "Cargando...",
                "processing":     "Procesando...",
                "search":       "Buscar:",
                "searchPlaceholder":  "Dato para buscar",
                "zeroRecords":      "No se han encontrado coincidencias.",
                "paginate": {
                  "first":      "Primera",
                  "last":       "Última",
                  "next":       "Siguiente",
                  "previous":     "Anterior"
                },
                "aria": {
                  "sortAscending":  "Ordenación ascendente",
                  "sortDescending": "Ordenación descendente"
                }
              };
  </script>

<style type="text/css">
	
	.texto{
		text-decoration: underline black;
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
		background-color:#282828;
		background-size:16px 16px; 
		font-family: Vegur, 'PT Sans', Verdana, sans-serif; border-radius: 5px; 
	}

</style>

<style>
.ProbandoColor{
  background-color: #FF0000;
  border-radius: 10px;

}
.ProbandoColor1{
  background-color: #00EA0D;
  color: #FFFFFF;
  border-radius: 10px;
}

.dataTables_wrapper .dataTables_length {
float: left;
text-align: center;
}
.dataTables_wrapper .dataTables_filter {  
float: right;
text-align: left;
}
.dataTables_wrapper .dataTables_paginate {  
float: right;
text-align: left;
}
.two-fields {
  width:100%;
}
.two-fields .input-group {
  width:100%;
}
.two-fields input {
  width:50% !important;
}
</style>
@endsection