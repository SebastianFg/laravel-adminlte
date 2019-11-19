@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      su usuario se encuentra suspendido
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('vehiculos.crear')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalAltaSiniestro"> <i class="fa fa-plus"> Nuevo</i> </button> 
                  @endcan
                  @can('vehiculos.imprimirLista')
                    <button type="button" id="redireccionar" class=" btn btn-danger" title="descargar lista de vehiculos en excel"> <i class="fa fa-file-pdf-o"> Imprimir lista</i> </button>
                  @endcan  
                </div>

{{--                 <div class="col-md-3">
                  <button type="button" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"> Buscar</i>  </button> 
                  <button type="button" id="btnLimpiar" class="btn btn-warning left"> <i class="fa fa-paint-brush"> Limpiar</i> </button> 
                </div> --}}
          </div>

          {{-- extiendo los modales --}}
          @extends('vehiculos/siniestros/modales/modal_alta_siniestro')
{{--           @extends('vehiculos/altas/modales/modal_baja_vehiculo')
          @extends('vehiculos/altas/modales/modal_editar_vehiculo') --}}
           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Vehiculos</u></strong>
                </div>

                <div class="card-body">
                  <div class="row">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="vehiculoBuscado" class="form-control" placeholder="numero de identificacion">
                        </div>
{{--                         <div class="col-md-">
                          <select name="id_tipo_vehiculo_lista"  class="form-control">
                            <option value="" selected="">Seleccione un tipo de vehiculo</option>
                            @foreach ($tipo_vehiculo as $item)
                              <option value="{{ $item->id_tipo_vehiculo }}">{{ $item->nombre_tipo_vehiculo }}</option>
                            @endforeach
                          </select>
                        </div> --}}
                        <div class="form-group">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                        </div>
                         
                      </div>
                    </form>
                  </div>
                  <div class="row">
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                      <thead>
                        <tr>
                          <th>N° Identificacion</th>
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
                      <tbody>
                        @foreach($siniestros as $item)
                        
                          <tr>
                            <td>{{ $item->numero_de_identificacion }}</td>
                            <td>{{ $item->nombre_dependencia }}</td>
                            <td>{{ $item->lugar_siniestro }}</td>
                            <td>{{ $item->fecha_siniestro }}</td>
                            @if($item->lesiones_siniestro == 1)
                              <td><label class="badge badge-danger">Si</label></td>
                            @else
                              <td><label class="badge badge-success">No</label></td>
                            @endif
                            <td>{{ $item->descripcion_siniestro }}</td>
                            <td>{{ $item->fecha_presentacion }}</td>
                            <td>{{ $item->observaciones_siniestro }}</td>

                            <td>
                              @can('vehiculos.informacion')
                                <a class="btn btn-info btn-sm" href="{{ route('detalleVehiculo',$item->id_vehiculo) }}"><i class="fa fa-info"></i></a>
                              @endcan
                              @can('vehiculos.editar') 
                                <button onclick="editarVehiculo({{ $item }})" title="Editar vehiculo"   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                              @endcan
                              @can('vehiculos.eliminar') 
                                <button  onclick="eliminarVehiculo('{{ $item->id_vehiculo }}','{{ $item->numero_de_identificacion }}');" title="Eliminar vehiculo"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

        {{--               <div class="row">
                          {{ $VehiculosListados->appends(Request::all())->links() }}
                      </div> --}}
                   {{--  @if(isset($existe))
                    @endif
 --}}
                  </div>
                </div>
              </div>
                          </div>
          {{-- card --}}
          </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
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

{{-- select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 

<script type="text/javascript">
  $("#id_vehiculo").select2({
    dropdownParent: $("#select"),
    placeholder:"Seleccione Vehiculo",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("listaVehiculos") }}',
      delay: 250,
      data: function (params) {

        console.log(params)
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        return {
            results:  $.map(data, function (item) {
                return {
                    text: item.dominio+' - N Identificacion '+item.numero_de_identificacion,
                    id: item.id_vehiculo,
                }
            })
        };
    },
    cache: true,

      },
  });
  function eliminarVehiculo(id_vehiculo,numero_de_identificacion){

    var numero_de_identificacion = $('#id_numero_de_identificacion_baja').val(numero_de_identificacion);
    var id_vehiculo = $('#id_vehiculo_baja').val(id_vehiculo);
    $('#modalBajaVehiculo').modal('show');
  }

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
