@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')
<link rel="shortcut icon" href="/img/logo.png">
<title>@yield('titulo', 'Patrimonio') | Dependencias</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset('css/chosen.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"> --}}
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
                  @can('dependencias.crearDependencia')
                  <button type="button" class="btn btn-success left" data-toggle="modal" data-target="#miModalDependencia"> <i class="fa fa-plus"> Nueva Dependencia</i> </button> 
                  @endcan
                </div>
              </div>
            </div>
          </div>
          {{-- modales --}}
          @extends('dependencias.modales.modal_alta_dependencia')
          @extends('dependencias.modales.modal_baja_dependencia')
          @extends('dependencias.modales.modal_edicion_dependencia')


            <div class="card">
              <div class="card-header">
                <strong><u>Dependencias</u></strong>
              </div>

              <div class="card-body">
                <div class="row col-md-12">
                  <form class="navbar-form navbar-right pull-right" role="search">
                    <div class="row">
                      <div class="form-group">
                        <input type="text" autocomplete="off"  name="nombreDependencia" class="form-control" placeholder="Ingrese nombre de dependencia">
                      </div>
                      <div class="form-group">
                        <select name="nivel_dependencia" class="form-control">
                          <option value="">Seleccione un tipo de Dependencia</option>
                          <option value="3">Dirección General</option>
                          <option value="4">Dirección</option>
                          <option value="5">Departamento</option>
                          <option value="6">División</option>
                          <option value="7">Sección</option>
                        </select>
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
                        <th>Dependencias</th>
                        <th>Padre</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($dependencias as $item)
                        <tr>
                          <td>{{ $item->hijo }}</td>
                          <td>{{ $item->padre }}</td>
                          @if($item->deleted_at)
                            <td><label class="badge badge-danger"> Inactivo {{ $item->deleted_at }}</label></td>
                          @else
                            <td><label class="badge badge-success">Activo</label></td>
                          @endif
                          <td>{{ $item->nombre_municipio }}</td>
                          <td>{{ $item->nombre_departamento }}</td>
                          <td>
                            @can('dependencias.editarDependencia')
                              <button  data-toggle="modal" onclick="editarDependencia({{$item }})" title="Editar Roles" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                            @endcan
                            @can('dependencias.eliminarDepencencia') 
                              <button  onclick="eliminarDependencia({{ $item }});" title="Eliminar Usuario"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            @endcan
                          
                  
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @if($existe)
                    <div class="row">
                        {{ $dependencias->appends(Request::all())->links() }}
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
{{-- <script scr="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> --}}
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>



<!-- OPTIONAL SCRIPTS -->
<script src="/dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 
<script src="{{asset('js/chosen.jquery.js')}}"></script>
<script type="text/javascript">

  function editarDependencia(item){
    var id_dependencia_nombre_hijo = $('#id_nombre_dependencia_editar').val(item.hijo),
        id_dependencia = $('#id_dependencia_editar').val(item.id_hijo);
    $('#idModalEdicionDependencia').modal('show');
  }
  function eliminarDependencia(item){

    var id_dependencia_nombre_hijo = $('#id_nombre_dependencia_hijo_eliminar').val(item.hijo),
        id_dependencia = $('#id_dependencia_eliminar').val(item.id_hijo),
        nivel = $('#id_nivel').val(item.nivel);
    $('#idModalBajaDependencia').modal('show');
  }

</script>
{{-- script para cargar el select de las dependencias padres --}}
<script>

  $(document).ready(function(){
/*    $('.chosen-select').chosen();*/

    $('#IdnivelDependencia').on('change',function(){
      var id_dependencia = $(this).val();

      if ($.trim(id_dependencia) != '') {
        $.get('getDependencias',{idDependenciaPadre: id_dependencia },function(dependencias){
         // console.log(dependencias)
            $('#id_dependencia_habilitada').empty();

            $('#id_dependencia_habilitada').append("<option value=''> Seleccione una dependencia padre</option>");
            $.each(dependencias,function(index,valor){
                $('#id_dependencia_habilitada').append("<option value='"+index+"'>"+valor+"</option>");
            });
            $('.chosen-select').trigger("chosen:updated");
        });
      }

    });
    $('#IdnivelDependenciaEditar').on('change',function(){
      var id_dependencia = $(this).val();
      console.log(id_dependencia)
      if ($.trim(id_dependencia) != '') {
        $.get('getDependencias',{idDependenciaPadre: id_dependencia },function(dependencias){
          console.log(dependencias)
            $('#id_dependencia_habilitada_padre_edicion').empty();

            $('#id_dependencia_habilitada_padre_edicion').append("<option value=''> Seleccione una dependencia padre</option>");
            $.each(dependencias,function(index,valor){
                $('#id_dependencia_habilitada_padre_edicion').append("<option value='"+index+"'>"+valor+"</option>");
            });
           $('.chosen-select-edi').trigger("chosen:updated");
        });
      }

    });
    $(".chosen-select").chosen({width: "100%"}).change(function () {
        var item = $(this).val();
        $('.chosen-select').trigger('chosen:updated');
    });
    $(".chosen-select-edi").chosen({width: "100%"}).change(function () {
        var item = $(this).val();
        $('.chosen-select').trigger('chosen:updated');
    });
   /* $('.chosen-select').chosen({
        width: "100%",
        search_contains:true,
        no_results_text: "Oops, no se encuentra!"
    });*/
  });


  $("#id_municipio").select2({
    dropdownParent: $("#select"),
    placeholder:"Ingrese nombre del municipio o departamento",
    allowClear: true,
    language: {
      noResults: function() {
        return "No hay resultado";        
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return 'Ingrese al menos 2 caracteres para comenzar a buscar';
      }
    },
    minimumInputLength: 2,
    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllMunicipios") }}',
      delay: 250,
      data: function (params) {
        
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        console.log(data)
        return {
            results:  $.map(data, function (item) {
              console.log(item)
                return {
                    text: item.nombre_municipio+' - Departamento: '+item.nombre_departamento,
                    id: item.id_municipio,
                }
            })
        };
    },
    cache: true,

      },
  });

  $("#id_municipio_editar").select2({
    dropdownParent: $("#select2"),
    placeholder:"Ingrese nombre del municipio o departamento",
    allowClear: true,
    minimumInputLength: 2,
    language: {
      noResults: function() {
        return "No hay resultado";        
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return 'Ingrese al menos 2 caracteres para comenzar a buscar';
      }
    },
    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ route("getAllMunicipios") }}',
      delay: 250,
      data: function (params) {
        
        return {
          termino: $.trim(params.term),
          page: params.page
        };
      },
      processResults: function (data) {
        console.log(data)
        return {
            results:  $.map(data, function (item) {
              console.log(item)
                return {
                    text: 'Municipio: '+item.nombre_municipio+' - Departamento: '+item.nombre_departamento,
                    id: item.id_municipio,
                }
            })
        };
    },
    cache: true,

      },
  });
</script>
@stop

<style type="text/css">
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}*/
.modal-body {
    position: relative;
    overflow-y: auto;
    max-height: 400px;
    padding: 15px;
}
</style>
{{-- 
<script
  src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
