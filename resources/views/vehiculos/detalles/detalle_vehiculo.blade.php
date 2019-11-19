@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->


  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else
    <div class="container-fluid"> 
      <hr>

          <div class="card">
            <div class="card-body">
              <form action="{{ route('detalleVehiculo') }}" class="navbar-form navbar-left pull-left" role="search">
                <div class="row">
                  
                  <div class="form-group">
                    <input type="text" name="vehiculoBuscado" class="form-control" placeholder="numero de identificacion">
                  </div>
                  <div class="form-group">
                     <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                  </div>
                   
                </div>
              </form>
            </div>
          </div> 

      
      <div class="row">

        @if($existe == 0)
        <p>no se puede ver</p>
        @else
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Detalle</h4>
              <br>
                @if(count($VehiculosListados)>0)
                  <label class="texto" >Numero de identificacion</label>
                  <p class="parrafos" >{{ $VehiculosListados[0]->numero_de_identificacion }}</p>
                  <label class="texto">Clase de unidad</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->clase_de_unidad  }}</p>                       
                  <label class="texto">Marca</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->marca  }}</p>
                  
                  <label class="texto">Modelo</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->modelo  }}</p>
                  
                  <label class="texto" >Chasis</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->chasis  }}</p>
                  
                  <label class="texto">Motor</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->motor  }}</p>
                  
                  <label class="texto">Año de produccion</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->anio_de_produccion  }}</p>
                  
                  <label class="texto">dominio </label>
                  <p class="parrafos" >{{$VehiculosListados[0]->dominio  }}</p>


                  <label class="texto">Kilometraje</label>
                  <p class="parrafos" >{{$VehiculosListados[0]->kilometraje  }} km</p>

                  <label  class="texto">Observaciones</label>
                  @if($VehiculosListados[0]->otras_caracteristicas == null)
                      <p class="parrafos">No posee obs.</p>
                  @else
                      <p class="parrafos" >{{$VehiculosListados[0]->otras_caracteristicas  }}</p>
                  @endif

                  <label class="texto">Fecha</label>
                  <p class="parroafos">{{$VehiculosListados[0]->fecha  }}</p>
                @else
                  asdas
                @endif
            </div>
          </div>
        </div>
          {{-- derecha --}}
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Afectado Actual</h4> 
              <br>
                @if(count($asignacion_actual)>0)
                  <label class="texto" >Dependencia Actual</label>
                  <p class="parrafos" >{{ $asignacion_actual[0]->nombre_dependencia }}</p>
                  <label class="texto" >Responsable de entrega</label>
                  <p class="parrafos" >{{ $asignacion_actual[0]->nombre }}</p>

                  <label  class="texto">Observaciones</label>

                    @if($VehiculosListados[0]->otras_caracteristicas == null)
                      <p class="parrafos">No posee obs.</p>
                    @else
                      <p class="parrafos" >{{$asignacion_actual[0]->observaciones  }}</p>
                    @endif
                @else
                  @if($VehiculosListados[0]->baja == 1)
                    <p>vehiculo fuera de servicio</p>
                  @endif
                  @if($VehiculosListados[0]->baja == 2)
                    <p>vehiculo dado de baja definitivamente</p>
                  @endif
                @endif
            </div>
          </div>
          
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Historial</h4> 
              <br>
              @if(count($historial))
                <table  tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
                  <thead>
                    <tr>
                      <th>Afectado</th>
                      <th>Fecha</th>
                      <th>Observaciones</th>
                    </tr>
                  </thead>
                    <tbody>
                        @foreach($historial as $item)
                          <tr>
                            <td>{{ $item->nombre_dependencia }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->observaciones }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                  {{ $historial->appends(Request::all())->links() }}
                </div>
              @else
                <p>no posee</p>
              @endif
            </div>
          </div>
        </div>
        </div>
    @endif
  @endif
  <!-- /.content -->
  </div>
  {{-- final --}}
</div>

@endsection

@section('javascript')
<!-- jQuery -->


<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

<script type="text/javascript">


  function editarVehiculo(item){
    console.log(item)
    var numero_de_identificacion = $('#id_numero_de_identificacion_modificacion').val(item.numero_de_identificacion),
        fecha = $('#id_vehiculo_modificacion').val(item.id_vehiculo),
        fecha = $('#id_fecha_modificacion').val(item.fecha),
        dominio = $('#id_dominio_modificacion').val(item.dominio),
        chasis = $('#id_chasis_modificacion').val(item.chasis),
        motor = $('#id_motor_modificacion').val(item.motor),
        modelo = $('#id_modelo_modificacion').val(item.modelo),
        marca = $('#id_marca_modificacion').val(item.marca),
        anio_de_produccion = $('#id_anio_produccion_modificacion').val(item.anio_de_produccion),
        numero_de_inventario = $('#id_numero_de_inventario_modificacion').val(item.numero_de_inventario),
        clases_de_unidad = $('#id_clase_de_unidad_modificacion').val(item.clase_de_unidad),
        tipo = $('#id_tipo_modificacion').val(item.tipo),
        kilometraje = $('#id_kilometraje_modificacion').val(item.kilometraje),
        otras_caracteristicas = $('#id_observaciones_modificacion').val(item.otras_caracteristicas);
        $('#modalEdicionVehiculo').modal('show');
  }

</script>
@stop
{{-- <style type="text/css">
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

</style> --}}

<style type="text/css">
	
	.texto{
		text-decoration: underline black;
	}
	.parrafos{
		font-family: Vegur, 'PT Sans', Verdana, sans-serif;
	}


</style>