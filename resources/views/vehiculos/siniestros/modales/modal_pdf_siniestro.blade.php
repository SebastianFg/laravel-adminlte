<div class="panel panel-success">
	<div class="panel-heading">Lista de PDF's <strong></strong> </div>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<div class="panel-body">
		<table  class=" table table-striped table-hover table-condensed table-bordered">
		<thead>

	       <tr>     
{{-- 		        <th>Fecha y hora</th>
		        <th>PDF</th> --}}
		        <th>Nombre PDF</th>
		        <th>Fecha</th>
			</tr>
	    </thead>
	    <tbody>
	    	@if(isset($historial_pdf))
		    	@if( $historial_pdf[0]->nombre_pdf_siniestro == null )
		    		<p>No Existen PDF's para descargar</p>
		    	@else
		 			@foreach ($historial_pdf as $item)
		 				<tr>
		        			<td><a href="{{ route('descargarPDF',$item->nombre_pdf_siniestro ) }}">{{ $item->nombre_pdf_siniestro  }}</a></td>
					        <td>{{ $item->fecha  }}</td>
				      	</tr>
					@endforeach
				@endif
			@else
				<p>No hay datos</p>
			@endif
	    </tbody>
		</table>

	</div>
</div>