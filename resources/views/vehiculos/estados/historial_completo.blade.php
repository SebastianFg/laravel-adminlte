@extends('plantilla')

@section('seccion')

<div class="panel panel-success">
{{-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gruas</li>
  </ol>
</nav>
 --}}


  
  <table id="listada_de_vehiculos" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
    <thead>
      <tr>

        <th>Numero de identificacion</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Dominio</th>
        <th>Numero de Inventario</th>
        <th>Acciones</th>
      </tr>
    </thead>
    
  </table>
</div>  
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"defer ></script>



<script>
   
    $(document).ready(function() {
    
      var table = $('#listada_de_vehiculos').DataTable({
            "destory":true,
            "searching": true,
            "serverSide": true,
            "autoWidth": true,
            "ordering": true,
            "responsive":true,
         
           "ajax":{"url":"{{ url('/historial_completo') }}","dataSrc":""},
            "columns": [
                {data: 'dominio'},
                {data: 'fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
               
            ],
            "language": Lenguaje_Español,
        });
    });
    var Lenguaje_Español = {
                "emptyTable":			"No hay datos disponibles en la tabla.",
                "info":		   			"Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                "infoPostFix":			"(actualizados)",
                "lengthMenu":			"Cantidad de registros _MENU_",
                "loadingRecords":		"Cargando...",
                "processing":			"Procesando...",
                "search":				"Buscar:",
                "searchPlaceholder":	"Dato para buscar",
                "zeroRecords":			"No se han encontrado coincidencias.",
                "paginate": {
                  "first":			"Primera",
                  "last":				"Última",
                  "next":				"Siguiente",
                  "previous":			"Anterior"
                },
                "aria": {
                  "sortAscending":	"Ordenación ascendente",
                  "sortDescending":	"Ordenación descendente"
                }
              };
  </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

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

