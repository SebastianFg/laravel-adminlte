@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Juzgados</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->

  <!-- /.content-header -->


  <!-- Main content -->
  <div class="content ">
    @if(strpos(Auth::User()->roles,'Suspendido'))
      Su usuario se encuentra suspendido!
    @else
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row ">
                <div class="col-md-3">
                  @can('juzgado.crear')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#modalAltaJuzgado"> <i class="fa fa-plus"> Nuevo Juzgado</i> </button> 
                  @endcan

                </div>

          </div>

          {{-- extiendo los modales --}}
{{--           @extends('vehiculos/altas/modales/modal_alta_vehiculo')
          @extends('vehiculos/altas/modales/modal_baja_vehiculo')
          @extends('vehiculos/altas/modales/modal_editar_vehiculo') --}}
          @extends('deposito_judicial/juzgados/modales/modal_alta_juzgado')
          @extends('deposito_judicial/juzgados/modales/modal_baja_juzgado')
          @extends('deposito_judicial/juzgados/modales/modal_editar_juzgado')
          @extends('vehiculos/modales/modal_detalle')
           </div>

            </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Lista de juzgados</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="juzgadoBuscado" class="form-control" placeholder="Ingrese Nombre - Dirección">
                        </div>
                        <div class="form-group">
                           <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                        </div>
                         
                      </div>
                    </form>
                  </div>
                  <div class="row table-responsive">
                    <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered responsive">
                      <thead>
                        <tr>

                          <th>Juzgado</th>
                          <th>Dirección</th>
                          <th>Télefono</th>
                          <th>Responsable</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($listaJuzgado as $item)
                        
                          <tr>
                            <td>{{ $item->nombre_juzgado }}</td>
                            {{-- <td>{{ $item->direccion_juzgado }}</td> --}}
                            <td>{{ substr($item->direccion_juzgado ,0,10) }}...<a href="" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->direccion_juzgado)) !!}')" data-toggle="modal" data-target="#modalDetalleRepuestos">ver mas</a></td>
                            <td>{{ $item->telefono_juzgado }}</td>
                            
                            <td>{{ substr($item->responsable_juzgado ,0,10) }}...<a href="" onclick="detalle('{!! preg_replace( "/\r|\n/", "", nl2br($item->responsable_juzgado)) !!}')" data-toggle="modal" data-target="#modalDetalleRepuestos">ver mas</a></td>
                           
                            <td>
                              @can('juzgado.editar') 
                                <button title="Editar Juzgado"  onclick="editarJuzgado({{$item }})" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                              @endcan
                              @can('juzgado.eliminar') 
                                <button  title="Eliminar Juzgado" onclick="eliminarJuzgado({{$item }})" class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                      <div class="row">
                          {{ $listaJuzgado->appends(Request::all())->links() }}
                      </div>
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

<script type="text/javascript">
  function detalle(item){

    $('#idDetalle').html(item);
    $('#modalDetalleLugar').modal('show');
  }

  function eliminarJuzgado(item){

    $('#id_juzgado_eliminar').val(item.id_juzgado);
    $('#id_nombre_juzgado_eliminar').val(item.nombre_juzgado);


    $('#modalBajaJuzgado').modal('show');
  }
  function editarJuzgado(item){
    console.log(item)
    $('#id_juzgado_editar').val(item.id_juzgado);
    $('#id_nombre_juzgado').val(item.nombre_juzgado);
    $('#id_direccion_juzgado').val(item.direccion_juzgado);
    $('#id_telefono_juzgado').val(item.telefono_juzgado);
    $('#id_responsable_juzgado').val(item.responsable_juzgado);

    $('#modalEdicionJuzgado').modal('show');
  }
</script>


@stop

