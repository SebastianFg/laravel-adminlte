
<div class="box box-danger col-md-12">
	<div class="box-body table-responsive">
	    <div class="card">
	      <table class="table-sm table  table-hover table-condensed">
	        <thead>
	          <tr>
	            <th>Dependencia</th>
	            <th>Cantidad</th>
	          </tr>
	        </thead>
	        <tbody>
              @foreach($detalleUnidadRegional as $item)
                <tr>
                  <td>{{$item->nombre_dependencia}}</td>
                  <td>{{$item->total}}</td>
                </tr>
              @endforeach
	        </tbody>

	      </table>
	    </div>
	</div>
</div>