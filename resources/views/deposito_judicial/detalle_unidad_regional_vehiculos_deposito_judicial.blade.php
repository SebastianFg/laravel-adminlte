
<div class="box box-danger col-md-12">
	<div class="box-body table-responsive">
	    <div class="card">
	      <table class="table-sm table  table-hover table-condensed">
	        <thead>
	          <tr>
	            <th>Num. de referencia</th>
	            <th>Marca</th>
	            <th>Dominio</th>
	            <th>Motor</th>
	            <th>Chasis</th>
	            <th>Num. de inventario</th>
	            <th>Fecha</th>
	          </tr>
	        </thead>
	        <tbody>
              @foreach($detalleUnidadRegionalVehiculos as $item)
                <tr>
                  <td>{{$item->numero_de_referencia_aleatorio_deposito_judicial}}</td>
                  <td>{{$item->marca_deposito_judicial}}</td>
                  <td>{{$item->dominio_deposito_judicial}}</td>
                  <td>{{$item->motor_deposito_judicial}}</td>
                  <td>{{$item->chasis_deposito_judicial}}</td>
                  <td>{{$item->numero_de_inventario_deposito_judicial}}</td>
                  <td>{{ date('d-m-Y', strtotime($item->fecha_deposito_judicial)) }}</td>

                 {{--  <td><button class="btn btn-info btn-sm" onclick="detalleUnidadRegionalVehiculo({{$item->id_dependencia}});"><i class="fa fa-info"></i></button></a></td> --}}
                </tr>
              @endforeach
	        </tbody>

	      </table>
	    </div>
	</div>
</div>