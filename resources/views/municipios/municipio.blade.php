@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<title>@yield('titulo', 'Patrimonio') | Municipios</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row" style="padding-top: 5px;">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  @can('municipios.crearLocalidad')
                  <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#idModalLocalidadAlta"> <i class="fa fa-plus"> Nuevo municipio</i> </button> 
                  @endcan
                </div>
              </div>
            </div>
          </div>
          {{-- modales --}}
          @extends('municipios.modales.modal_alta_municipio')
          @extends('municipios.modales.modal_baja_municipio')
          @extends('municipios.modales.modal_modificacion_municipio')


            <div class="card">
              <div class="card-header">
                <strong><u>Localidades</u></strong>
              </div>

              <div class="card-body">
                <div class="row col-md-12">
                  <form class="navbar-form navbar-right pull-right" role="search">
                    <div class="row">
                      <div class="form-group">
                        <input type="text" autocomplete="off"  name="nombreMunicipio" class="form-control" placeholder="ingrese municipio">
                      </div>
                      <div class="form-group">
                         <button type="submit" id="btnBuscar" class="btn btn-info left"> <i class="fa fa-search-plus"></i>Buscar  </button> 
                      </div>
                    </div>
                  </form>
                </div>
                <div class="row table-responsive" >
                  
                
                  <table tableStyle="width:auto" class="table table-striped table-hover table-sm table-condensed table-bordered">
                    <thead>
                      <tr>
                        <th>Municipio</th>
                        <th>Departamento</th>
                        <th>Poblacion</th>
                        <th>Zona</th>
                        <th>Unidad Regional</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($municipios as $item)
                        <tr>
                          <td>{{ $item->nombre_municipio }}</td>
                          <td>{{ $item->nombre_departamento }}</td>
                          <td>{{ $item->poblacion }}</td>
                          <td>{{ $item->zona }}</td>
                          <td>{{ $item->ur }}</td>
                          <td>
                            @can('municipios.editarLocalidad')
                              <button  data-toggle="modal" onclick="editarMunicipio({{$item }})" title="Editar Localidad" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                            @endcan
                            @can('municipios.eliminarLocalidad') 
                              <button  onclick="eliminarMunicipio({{ $item }});" title="Eliminar Localidad"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            @endcan
                          
                  
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @if(count($municipios)>0)
                    <div class="row">
                        {{ $municipios->appends(Request::all())->links() }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
        {{-- col 12 --}}
        </div>
      {{-- row --}}
      </div>
    {{-- fluid --}}
    </div>
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

  function editarMunicipio(item){
    console.log(item)
    var id_municipio_editar = $('#id_municipio').val(item.id_municipio),
        nombre_municipio = $('#id_nombre_municipio').val(item.nombre_municipio),
        nombre_departamento = $('#id_nombre_departamento').val(item.nombre_departamento),
        poblacion = $('#id_poblacion_municipio').val(item.poblacion),
        varones = $('#id_varones_municipio').val(item.varones),
        mujeres = $('#id_mujeres_municipio').val(item.mujeres),
        zona = $('#id_zona_municipio').val(item.zona),
        ur = $('#id_ur_municipio').val(item.ur);
    $('#idModalEdicionMunicipio').modal('show');
  }
  function eliminarMunicipio(item){
    console.log(item)
    var id_municipio = $('#id_municipio_baja').val(item.id_municipio),
        nombre_municipio = $('#id_municipio_nombre').val(item.nombre_municipio);
    $('#idModalBajaMunicipio').modal('show');
  }

</script>

@stop

{{-- 
<script
  src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
