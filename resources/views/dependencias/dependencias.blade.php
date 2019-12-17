@extends('layouts.master')

{{-- ES LA VERSION 3 DE LA PLANTILLA DASHBOARD --}}
@section('content')

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
                <strong><u>Lista de Dependencias</u></strong>
              </div>

              <div class="card-body">
                <div class="row col-md-12">
                  <form class="navbar-form navbar-right pull-right" role="search">
                    <div class="row">
                      <div class="form-group">
                        <input type="text" autocomplete="off"  name="nombreDependencia" class="form-control" placeholder="ingrese nombre de dependencia">
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
<!-- Bootstrap -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="/dist/js/demo.js"></script>

<script type="text/javascript">

  function editarDependencia(item){
    console.log(item)
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
    $('#IdnivelDependencia').on('change',function(){

      var id_dependencia = $(this).val();

      if ($.trim(id_dependencia) != '') {
        $.get('getDependencias',{idDependenciaPadre: id_dependencia },function(dependencias){
         // console.log(dependencias)
            $('#id_dependencia_habilitada').empty();

            $('#id_dependencia_habilitada').append("<option value=''> Seleccione una dependencia padre</option>");
            $.each(dependencias,function(index,valor){
              console.log('as')
                $('#id_dependencia_habilitada').append("<option value='"+index+"'>"+valor+"</option>");
            });
        });
      }
    });
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
