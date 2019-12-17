
  <div class="table-responsive ">
      <table id="listada_de_vehiculos" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
    <thead>
      <tr>
          <th>Afectado</th>
          <th>Marca</th>
          <th>Año</th>
          <th>Dominio</th>
          <th>Motor</th>
          <th>Chasis</th>
          <th>N de identificación</th>
        
      
      </tr>
    </thead>
    <tbody>

      @foreach ($listado as $item)
      <tr>
        <td>{{ $item->afectado  }}</td>
        <td>{{ $item->marca_seleccion  }}</td>
        <td>{{ $item->anio_de_produccion  }}</td>
        <td>{{ $item->dominio  }}</td>
        <td>{{ $item->motor  }}</td>
        <td>{{ $item->chasis  }}</td>
        <td>{{ $item->numero_de_identificacion  }}</td>

      </tr>
      @endforeach
    </tbody>
    
  </table>
        <div class="row">
        {{ $paginatedItems->links() }}
    </div>
  </div>
