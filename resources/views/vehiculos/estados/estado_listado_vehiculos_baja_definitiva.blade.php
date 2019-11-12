@extends('plantilla')

@section('seccion')
<div class="panel panel-success">
  <div class="panel panel-heading">Lstado de vehiculos dados de baja definitivamente</div>
  {{-- Modal alta vehiculos estado --}}
 @extends('vehiculos/estados/modal_alta_vehiculo_estado')
  {{-- Modal alta vehiculos estado --}}
 @extends('vehiculos/estados/modal_baja_total_vehiculos')

{{--   <div class="panel-heading"> Lista de vehiculos fuera de servicio</div> --}}
  <div class="pane panel-body ">
        <a href="{{ route('listadoEstadoVehiculo') }}" class="btn btn-default">Listado de vehiculos fuera de servicio</a>
        <button onclick="listarHistorial();" class="btn btn-default" data-toggle="modal" data-target="#modalHistorialVehiculos"> Historial completo</button>
    <table id="listada_de_vehiculos_baja_definitiva" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
      <thead>
        <tr>

          <th>Dominio</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>

    </table>
    @extends('vehiculos/altas/script')
  </div>


  {{-- Modal detalle estado individual --}}

  <div class="modal fade" id="modalVehiculosDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detalles del vehiculo </h4>
            </div>
            @if(!$errors->isEmpty())
            <div class="alert alert-danger">
              <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach()
              </ul>
            </div>
            @endif
            <div class="modal-body ">
            

                @csrf
                <div class="panel panel-success" id="modalopen"></div>
 
      
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="modalHistorialVehiculos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Historial Completo </h4>
            </div>
            @if(!$errors->isEmpty())
            <div class="alert alert-danger">
              <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach()
              </ul>
            </div>
            @endif
            <div class="modal-body ">
              <div class="panel panel-success">
                <table id="listaHistorial" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Dominio</th>
                      <th>N de inventario</th>
                      <th>Estado</th>
                      <th>Razon</th>
                      <th>Usuario</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>


<script>
   var listarHistorialIndividual = function(){
    $("#listaHistorial").dataTable().fnDestroy();

    $('#listaHistorial').DataTable({

           "sdom": 'Blrtip',
            "select":true,
            "searching": true,
            "destory":true,
            "autoWidth": true,
            "ordering": true,
            "responsive":true,
            "json":false,
            "order": [[ 0, "desc" ]],
            "ajax":{"url":"{{ url('/admin/historial_completo') }}","dataSrc":""},
            "columns": [
                {data: 'fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
                {data: 'dominio'},
                {data: 'numero_de_inventario'},
                /*{data: 'tipo_estado_vehiculo'},*/
                {data: 'tipo_estado_vehiculo',
                  createdCell: function (td, cellData, rowData, row, col) {
                    if ( cellData ==0 ) {
                      $(td).addClass('coloReparado');
                    }else if( cellData == 1) {
                      $(td).addClass('colorFueraservicio');
                    }else if( cellData == 2) {
                      $(td).addClass('colorBajaDefinitiva');
                    }
                  },
                  searchable: true, render: function( data, type, row, meta ){
                    if (data == 0) {
                      return '<i class="glyphicon glyphicon-remove"></i><strong > Fuera de servicio</strong>';
                    }else if(data == 1) {
                      return '<i class="glyphicon glyphicon-ok"></i><strong > Reparado</strong>';
                    }else if(data == 2) {
                      return '<i class="glyphicon glyphicon-ok"></i><strong > Baja Definitiva</strong>';
                    }
                  } 
              },
                {data: 'estado_razon'},
                {data: 'name'},
            ],
            "language": Lenguaje_Español,
        });
    }

  var listarHistorial = function(){
    $("#listaHistorial").dataTable().fnDestroy();

    $('#listaHistorial').DataTable({

           "sdom": 'Blrtip',
            "select":true,
            "searching": true,
            "destory":true,
            "autoWidth": true,
            "ordering": true,
            "responsive":true,
            "json":false,
            "order": [[ 0, "desc" ]],
            "ajax":{"url":"{{ url('/admin/historial_completo') }}","dataSrc":""},
            "columns": [
                {data: 'fecha'},
                {data: 'dominio'},
                {data: 'numero_de_inventario'},
                /*{data: 'tipo_estado_vehiculo'},*/
                {data: 'tipo_estado_vehiculo',
                  createdCell: function (td, cellData, rowData, row, col) {
                    if ( cellData ==0 ) {
                      $(td).addClass('coloReparado');
                    }else if( cellData == 1) {
                      $(td).addClass('colorFueraservicio');
                    }else if( cellData == 2) {
                      $(td).addClass('colorBajaDefinitiva');
                    }
                  },
                  searchable: true, render: function( data, type, row, meta ){
                    if (data == 0) {
                      return '<i class="glyphicon glyphicon-remove"></i><strong > Fuera de servicio</strong>';
                    }else if(data == 1) {
                      return '<i class="glyphicon glyphicon-ok"></i><strong > Reparado</strong>';
                    }else if(data == 2) {
                      return '<i class="glyphicon glyphicon-ok"></i><strong > Baja Definitiva</strong>';
                    }
                  } 
              },
                {data: 'estado_razon'},
                {data: 'name'},
            ],
            "language": Lenguaje_Español,
        });
    }

    $(document).ready(function() {

      var table = $('#listada_de_vehiculos_baja_definitiva').DataTable({
            "sdom": 'Blrtip',
            "select":true,
            "searching": true,
            "destory":true,
            "autoWidth": true,
            "ordering": true,
            "responsive":true,
            "json":false,

         
           "ajax":{"url":"{{ url('/admin/historial_vehiculos_baja_definitiva') }}"},
            "columns": [
                {data: 'dominio'},
                {data: 'fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },

                {"defaultContent": '<button title="detalles" class="detallesbtn btn btn-info btn-sm"><span aria-hidden="true" class="glyphicon glyphicon-eye-open"></span></button></span><button data-toggle="modal" data-target="#modalVehiculosDetalle" title="mas detalles"  class=" masDetallesbtn btn btn-warning btn-sm"><span class="glyphicon glyphicon-plus"></span></button>'},
               
            ],
            "language": Lenguaje_Español,
        });
        obtener_data_detalles("#listada_de_vehiculos_baja_definitiva",table);
        obtener_data_mas_detalles("#listada_de_vehiculos_baja_definitiva",table);
      
    });

    var redireccionar_detalles = function(data){
      window.location.href = "http://127.0.0.1:8000/admin/detalleVehiculo/"+data;
    }
    var obtener_data_detalles = function(tbody,table){
      $(tbody).on("click","button.detallesbtn",function(){
        var data = table.row($(this).parents("tr")).data();
     //   console.log(data.id_vehiculo);
        redireccionar_detalles(data.id_vehiculo)
         
      }); 
    }

    function obtener_data_mas_detalles(tbody,table) {
     $(tbody).on("click","button.masDetallesbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        console.log(data.id_vehiculo);

       $.ajax({
          url: '/admin/detalleVehiculoController',
          data:{
                  "_token": $('meta[name="csrf-token"]').attr('content'),
                  "id_vehiculo" :data.id_vehiculo,

                  },
          type: "post",
          success: function(r){
           $('#modalopen').html(r);
          
            
            
          }
          ,'error': function(data){
            console.log('as');
              console.log( 'oops', data );
          }
        });
      }); 
    }


    var Lenguaje_Español = {
                "emptyTable":     "No hay datos disponibles en la tabla.",
                "info":           "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":      "Mostrando 0 registros de un total de 0.",
                "infoFiltered":     "(filtrados de un total de _MAX_ registros)",
                "infoPostFix":      "(actualizados)",
                "lengthMenu":     "Cantidad de registros _MENU_",
                "loadingRecords":   "Cargando...",
                "processing":     "Procesando...",
                "search":       "Buscar:",
                "searchPlaceholder":  "Dato para buscar",
                "zeroRecords":      "No se han encontrado coincidencias.",
                "paginate": {
                  "first":      "Primera",
                  "last":       "Última",
                  "next":       "Siguiente",
                  "previous":     "Anterior"
                },
                "aria": {
                  "sortAscending":  "Ordenación ascendente",
                  "sortDescending": "Ordenación descendente"
                }
              };
  </script>

<script type="text/javascript">

</script>
<style>
.coloReparado{
  background-color: #29F000;
  border-radius: 30px;

}
.colorFueraservicio{
  background-color: #F7EB03;
  color: #FFFFFF;
  border-radius: 30px;
}
.colorBajaDefinitiva{
  background-color: #CB0000;
  color: #FFFFFF;
  border-radius: 30px;
}

.dataTables_wrapper .dataTables_length {
float: left;
text-align: center;
}
.dataTables_wrapper .dataTables_filter {  
float: right;
text-align: left;
}
.dataTables_wrapper .dataTables_paginate {  
float: right;
text-align: left;
}
.two-fields {
  width:100%;
}
.two-fields .input-group {
  width:100%;
}
.two-fields input {
  width:50% !important;
}
</style>

@endsection
