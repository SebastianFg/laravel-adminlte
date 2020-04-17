@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Detalles</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      <div class="row ">
        <div class="card col-sm-12">
          <div class="card-body">
            <h4 class="card-title">Su usuario se encuentra suspendido, contacte con un administrador!</h4> 
            <br>
          </div>
        </div>
      </div>
    @else
    <div class="container-fluid"> 
      <hr>
      <div class="card">
        <div class="card-header">
          <h3><u>Detalles del Automotor</u></h3>
        </div>
      </div> 
          @extends('vehiculos/modales/modal_detalle')
      
{{--         @if($existe == 0)

        <div class="row ">
          <div class="card col-sm-12">
            <div class="card-body">
              <h4 class="card-title">Ingrese numero de identificación o dominio del vehículo</h4> 
              <br>
            </div>
          </div>
        </div>

        @else --}}
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                 <strong><u>Datos del vehículo</u></strong>
              </div>
              <div class="card-body">
                  @if(count($VehiculosListados)>0)
                    <label class="texto" >Número de referencia aleatorio</label>
                    <p class="parrafos" >{{ $VehiculosListados[0]->numero_de_referencia_aleatorio_deposito_judicial }}</p>
                    <label class="texto" >Número de identificación</label>
                    <p class="parrafos" >{{ $VehiculosListados[0]->numero_de_identificacion_deposito_judicial }}</p>
                    <label class="texto">Clase de unidad</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->clase_de_unidad_deposito_judicial  }}</p>                       
                    <label class="texto">Marca</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->marca_deposito_judicial  }}</p>
                    
                    <label class="texto">Modelo</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->modelo_deposito_judicial  }}</p>
                    
                    <label class="texto" >Chasis</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->chasis_deposito_judicial  }}</p>
                    
                    <label class="texto">Motor</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->motor_deposito_judicial  }}</p>
                    
                    <label class="texto">Año de producción</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->anio_de_produccion_deposito_judicial  }}</p>
                    
                    <label class="texto">Dominio </label>
                    <p class="parrafos" >{{$VehiculosListados[0]->dominio_deposito_judicial  }}</p>

                    <label class="texto">Número de inventario</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->numero_de_inventario_deposito_judicial  }}</p>

                    <label class="texto">Kilometraje</label>
                    <p class="parrafos" >{{$VehiculosListados[0]->kilometraje_deposito_judicial  }} km</p>

                    <label  class="texto">Observaciones</label>
                    @if($VehiculosListados[0]->otras_caracteristicas_deposito_judicial == null)
                        <p class="parrafos">No posee obs.</p>
                    @else
                        <p class="parrafos" >{{$VehiculosListados[0]->otras_caracteristicas_deposito_judicial  }}</p>
                    @endif

                    <label class="texto">Fecha</label>
                    <p class="parroafos">{{ date('d-m-Y', strtotime($VehiculosListados[0]->fecha_deposito_judicial )) }}</p>
                  @else
                    asdas
                  @endif
              </div>
            </div>
          </div>
            {{-- derecha --}}
          <div class="col-md-6">
            <div class="card table-responsive">
              <div class="card-header">
                 <strong><u>Afectado actual</u></strong>
              </div>
              <div class="card-body">
                  @if(count($asignacion_actual)>0)
                    <label class="texto" >Dependencia Actual</label>
                    <p class="parrafos" >{{ $asignacion_actual[0]->nombre_dependencia }}</p>
                      <hr>
                      @if($asignacion_actual[0]->id_dependencia == 392 and isset($Mandatario_Dignatario))
                        <label class="texto">Entidad:</label>
                        <p class="parrafos" >{{ $Mandatario_Dignatario[0]->nombre_entidad }}
                        <hr>
                        <label class="texto">Responsable:</label>
                        <p class="parrafos" >{{ $Mandatario_Dignatario[0]->nombre_mandatario_dignatario }}
                        <hr>
                      @endif

                      
                      <label class="texto" >Responsable de entrega</label>
                      <p class="parrafos" >{{ $asignacion_actual[0]->nombre }}</p>
                      <hr>
                      <label  class="texto">Observaciones</label>

                      @if($asignacion_actual[0]->observaciones == null)
                        <p class="parrafos">No posee obs.</p>
                      @else
                        <p class="parrafos" >{{$asignacion_actual[0]->observaciones  }}</p>
                      @endif
                  @else
                    @if($VehiculosListados[0]->baja == 0)
                      <p>Vehículo sin asignar</p>
                    @endif
                    @if($VehiculosListados[0]->baja == 1)
                      <p>Vehículo fuera de servicio</p>
                    @endif
                    @if($VehiculosListados[0]->baja == 2)
                      <p>Vehículo dado de baja definitivamente</p>
                    @endif
                  @endif
              </div>
            </div>
            
            <div class="card table-responsive">
              <div class="card-header">
                 <strong><u>Historial</u></strong>
              </div>
              <div class="card-body table-responsive ">
                @if(count($historial)>0)
                  <label> 
                    <strong><a title="Descargar historial en PDF" href="{{ route('pdfVehiculosDP',$VehiculosListados[0]->id_vehiculo_deposito_judicial) }}" ><i class="fa fa-file-pdf"></i> Descargar historial completo</a></strong>
                  </label>
                  <hr>
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
                              <td>{{ date('d-m-Y', strtotime($item->fecha )) }}</td>
                              
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
        <div class="row table-responsive ">
          <div class="card">
            <div class="card-header">
               <strong><u>Siniestros</u></strong>
            </div>
            <div class="card-body">
              @if(count($siniestros) >0)
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                      <thead>
                        <tr>
                          <th>N° Identificación</th>
                          <th>Afectado</th>
                          <th>Lugar</th>
                          <th>Fecha</th>
                          <th>Lesiones</th>
                          <th>Colision</th>
                          <th>Presentación</th>
                          <th>Observaciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($siniestros as $item)
                        
                          <tr>
                            <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                            <td>{{ $item->nombre_dependencia }}</td>
                            <td>{{ substr($item->lugar_siniestro ,0,10) }}...<a href="" onclick="detalle('{{ $item->lugar_siniestro }}')" data-toggle="modal" data-target="#modalDetalleLugar">ver mas</a>
                            </td>

                            <td>{{ date('d-m-Y', strtotime($item->fecha_siniestro_deposito_judicial)) }}</td>
                            @if($item->lesiones_siniestro == 1)
                              <td><label class="badge badge-danger">Si</label></td>
                            @else
                              <td><label class="badge badge-success">No</label></td>
                            @endif
                            <td>{{ substr($item->descripcion_siniestro_deposito_judicial,0,10) }}...<a href="" onclick="detalle('{{ $item->descripcion_siniestro_deposito_judicial }}')" data-toggle="modal" data-target="#modalDetalleDesc">ver mas</a>
                            </td>

                            <td>{{ date('d-m-Y', strtotime($item->fecha_presentacion_deposito_judicial)) }}</td>
                            <td>{{ substr($item->observaciones_siniestro_deposito_judicial,0,10) }}...<a href="" onclick="detalle('{{ $item->observaciones_siniestro_deposito_judicial }}')" data-toggle="modal" data-target="#modalDetalleObs">ver mas</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  <div class="row">
                    {{ $siniestros->appends(Request::all())->links() }}
                  </div>
              @else
                <p>no posee</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row table-responsive ">
          <div class="card">
            <div class="card-header">
               <strong><u>Repuestos</u></strong>
            </div>
            <div class="card-body">
              @if(count($repuestos) >0)
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                      <thead>
                        <tr>
                      <th>Dominio</th>
                      <th>Fecha</th>
                      <th>Responsable</th>
                      <th>N de identificación</th>
                      <th>Marca</th>
                      <th>clase de unidad</th>
                      <th>Repuestos</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach($repuestos as $item)
                    
                      <tr>
                        <td>{{ $item->dominio_deposito_judicial }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->fecha_deposito_judicial )) }}</td>
                        <td>{{ $item->usuario }}</td>
                        <td>{{ $item->numero_de_referencia_aleatorio_deposito_judicial }}</td>
                        <td>{{ $item->marca_deposito_judicial }}</td>
                        <td>{{ $item->clase_de_unidad_deposito_judicial }}</td>
                        
                         <td>{{ substr($item->repuestos_entregados_deposito_judicial ,0,15) }}...<a href="" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->repuestos_entregados_deposito_judicial)) !!}')"  data-toggle="modal" data-target="#modalDetalleRepuestos">ver mas</a>
                      </tr>
                    @endforeach
                      </tbody>
                    </table>
                  <div class="row">
                    {{ $repuestos->appends(Request::all())->links() }}
                  </div>
              @else
                <p>no posee</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="card col-sm-12">
            <div class="card-header">
               <strong><u>Imagenes</u></strong>
            </div>
            <div class="card-body">
              <br>
                @if(count($imagenes_vehiculo)>0)
    
                <div class="col-md-12 "  >
                  <div id="carrousel" class="carousel slide" data-ride="carousel">
                   
                    <ol class="carousel-indicators">
                       @foreach( $imagenes_vehiculo as $photo )
                          <li data-target="#carrousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}">asdasdas</li>
                       @endforeach
                    </ol>
                   
                    <div class="carousel-inner" >
                    
                      @foreach( $imagenes_vehiculo as $photo )
                      
                         <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                            <img src="{{  route('storageJudicial',['carpeta'=>$VehiculosListados[0]->numero_de_referencia_aleatorio_deposito_judicial,'archivo'=>$photo->nombre_imagen]) }}" alt="Card image cap">
                         </div>
                         
                      @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carrousel" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Siguiente</span>
                    </a>
                    <a class="carousel-control-next" href="#carrousel" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                  </div>
                </div>
              </div>
              @else
                <p> El vehículo no posee imagenes</p>
              @endif
            </div>
          </div>
        </div>
        @endif
  <!-- container-fluid -->
      </div>
  {{-- content --}}
      {{-- @endif --}}
  </div>
  {{-- content-wrapper --}}
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
  function detalle(item){
    $('#idDetalle').html(item);
    $('#modalDetalleLugar').modal('show');
  }

</script>
@stop
{{-- <style type="text/css">
.card {
  box-shadow: 100px 100px 100px 10 rgba(0,0,0,0.2);
}

</style> --}}

<style type="text/css">
	
	.texto{
		text-decoration: underline black;
	}
	.parrafos{
		font-family: Vegur, 'PT Sans', Verdana, sans-serif;
	}
.carousel-inner img {
    width: 100%;
    max-height: 460px;
}

.carousel-inner{
 height: 400px;
}

</style>