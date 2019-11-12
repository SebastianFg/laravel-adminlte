@extends('plantilla')

@section('seccion')

<div class="panel panel-success ">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
{{--   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item active" aria-current="page">Asignar Repuestos</li>
    </ol>
  </nav>
 --}}
 <div class="panel panel-heading">

    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#miModal"> <i class="glyphicon glyphicon-plus"></i> Asignar Repuesto</button>  
 </div>
 {{-- modal --}}
 @extends('vehiculos/repuestos/modal_asignacion_repuestos')
<div class="panel panel-body">

    <table id="listada_de_vehiculos_repuestos" tableStyle="width:auto"  class="table table-striped table-hover table-condensed table-bordered">
      <thead>
        <tr>
          <th>Dominio</th>
          <th>Fecha</th>
          <th>Responsable</th>
          <th>N de identificacion</th>
          <th>Marca</th>
          <th>clase de unidad</th>
          <th>Repuestos</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>

 </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer ></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 


<script>
   
    $(document).ready(function() {
      var table = $('#listada_de_vehiculos_repuestos').DataTable({
            "sdom": 'Blrtip',
            "select":true,
            "searching": true,
            "destory":true,
            "autoWidth": true,
            "ordering": true,
            "responsive":true,
            
            "json":false,
            "ajax":{"url":"{{ url('/admin/vehiculos_repuestos_asignados') }}"},
            "columns": [
                {data: 'dominio'},
                {data: 'fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
                {data: 'name'},
                {data: 'numero_de_identificacion'},
                {data: 'marca'},
                {data: 'clase_de_unidad'},
                {data: 'repuestos_entregados'},
                {"defaultContent": '<button title="detalles" class="detallesbtn btn btn-info btn-sm"><span aria-hidden="true" class="glyphicon glyphicon-eye-open"></span></button></span></button><button  title="Descargar PDF"  class="Descargarbtn btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></button>'},
            ],
            "language": Lenguaje_Español,
        });
        obtener_data_detalles("#listada_de_vehiculos_repuestos",table);
        descaargar_vehiculo("#listada_de_vehiculos_repuestos",table);
        
    });
    var redireccionar_detalles = function(data){
      window.location.href = "http://127.0.0.1:8000/admin/detalleVehiculo/"+data;
    
    }
    var redireccionar_descargar_pdf_cargo = function(data){
      console.log(data)
      window.location.href = "http://127.0.0.1:8000/admin/asignar_vehiculos_repuestos/"+data;
      
    }
    var obtener_data_detalles = function(tbody,table){
      $(tbody).on("click","button.detallesbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        //console.log(data)
        redireccionar_detalles(data.id_vehiculo)
         
      }); 
    }

    var descaargar_vehiculo = function(tbody,table){
      $(tbody).on("click","button.Descargarbtn",function(){
        var data = table.row($(this).parents("tr")).data();
      //  console.log(data)
        redireccionar_descargar_pdf_cargo(data.id_detalle_repuesto);
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
  


$.fn.select2.defaults.set('language', 'es');

$("#id_vehiculo").select2({
  dropdownParent: $("#select"),
  placeholder:"Seleccione Vehiculo",
  allowClear: true,
  minimumInputLength: 2,

  type: "GET",
  ajax: {
    dataType: 'json',
    url: '{{ url("admin/vehiculos_select") }}',
    delay: 250,
    data: function (params) {

      return {
        termino: $.trim(params.term),
        page: params.page
      };
    },
    processResults: function (data) {

      return {
          results:  $.map(data, function (item) {
            console.log(data)
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

</script>


<style>

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

