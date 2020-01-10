@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->
  <title>@yield('titulo', 'Patrimonio') | Jefatura</title>
  <!-- /.content-header -->

  {{-- extiendo los modales --}}
          @extends('Elementos/modales/modal_alta_elementos')
          @extends('Elementos/modales/modal_baja_elementos')
          @extends('Elementos/modales/modal_editar_elementos')

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
                  @can('crear.Elementos')
                    <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#miModal"> <i class="fa fa-plus"> Nuevo</i> </button> 
                  @endcan
                  @can('imprimirLista.Elementos')
                    <a type="button" id="redireccionar" class=" btn btn-danger" href="{{ route('exportarPdfVehiculos') }}"><i class="fa fa-file-pdf-o"> Imprimir lista completa</i> </a>
                  @endcan  
                </div>
            </div>
          
              </div>

              <hr>
              <div class="card">
                <div class="card-header">
                  <strong><u>Elementos</u></strong>
                </div>

                <div class="card-body">
                  <div class="row col-md-12">
                    <form model="" class="navbar-form navbar-left pull-right" role="search">
                      <div class="row">
                        
                        <div class="form-group">
                          <input type="text" name="vehiculoBuscado" class="form-control" placeholder="Numero Serial">
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

                          <th>Descripcion</th>
                          <th>Modelo</th>
                          <th>Marca</th>
                          <th>Serial</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $item)
                        
                          <tr>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->modelo }}</td>
                            <td>{{ $item->marca }}</td>
                            <td>{{ $item->serial }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>
                            @can('editar.Elementos') 
                                <button onclick="editarElemento({{ $item }})" title="Editar elemento"   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                              @endcan
                              @can('eliminar.Elementos') 
                                <button  onclick="eliminarElemento('{{ $item->id }}','{{ $item->descripcion }}');" title="Eliminar elemento"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                              @endcan
                            </td>
                          
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                     
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
  function eliminarElemento(id_elemento,id_descripcion){
    // console.log(id_elemento);

    var id_descripcion = $('#id_descripcion_baja').val(id_descripcion);
    var id_elemento = $('#id_elemento_baja').val(id_elemento);
    $('#modalBajaElementos').modal('show');
  }

  function editarElemento(item){
    console.log(item);
    var numero_de_identificacion = $('#id_descripcion_elementos').val(item.descripcion),
        fecha = $('#id_elementos').val(item.id),
        modelo = $('#id_modelo_elementos').val(item.modelo),
        marca = $('#id_marca_elementos').val(item.marca),
        fecha = $('#id_fecha_elementos').val(item.fecha),
        serial = $('#id_serial_elementos').val(item.serial);
        $('#modalEdicionElemento').modal('show');
  }
</script>

@stop
