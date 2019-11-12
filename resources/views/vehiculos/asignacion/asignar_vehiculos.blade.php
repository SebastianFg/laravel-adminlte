@extends('plantilla')

@section('seccion')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

<div class="panel panel-success">
{{-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Asignar</li>
  </ol>
</nav> --}}

  <div class="panel panel-heading ">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModal"> <i class="glyphicon glyphicon-plus"></i> Nueva Asignacion</button>  
  </div>  
   @extends('vehiculos/modales/modal_asignacion')
   @extends('vehiculos/modales/modal_edicion_vehiculo_asignado')
    <div class="col-md-12 panel panel-body">
    <table id="lista_afectados" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
      <thead>
        <tr>
          <th>Dominio</th>
          <th>Afectado</th>
          <th>Fecha</th>
          <th>Numero de identificacion</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>N de inventario</th>
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
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"defer></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"defer></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script> 




<script>
   
    $(document).ready(function() {
      var table = $('#lista_afectados').DataTable({
            "sdom": 'Blrtip',
           // "pageLength": 5,
            "bSort": true,
            "bprocessing": true,
            "bserverSide": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
         /*   "ordering": true,*/
            "bInfo": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "bAutoWidth": false,
    /*        "lengthMenu": [[5,10,100,-1],["5","10","100","Todos"]],*/
            "json":false,
            "ajax":{"url":"{{ url('/admin/lista_total_afectados') }}"},
            "columns": [
                {data: 'dominio'},
                {data: 'destino'},
                {data: 'fecha',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },

                {data: 'numero_de_identificacion'},
                {data: 'marca'},
                {data: 'modelo'},
                {data: 'numero_de_inventario'},

                {data:'destino',
                "render":function (value) {
                  if (value == 'plana mayor')

                 
                  return '<button title="detalles" class="detallesbtn btn btn-info btn-sm"><span aria-hidden="true" class="glyphicon glyphicon-eye-open"></span></button><button data-toggle="modal" data-target="#modaEdicionAsignacion" title="mas detalles"  class=" Editarbtn btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button><button  title="Descargar PDF"  class="Descargarbtn btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></button>';
                  else
                    return ''}
                },
            ],
            "language": Lenguaje_Español,
        });
        obtener_data_detalles("#lista_afectados",table);
        editar_vehiculo("#lista_afectados",table);
        descaargar_vehiculo("#lista_afectados",table);
    });
    var redireccionar_detalles = function(data){
      window.location.href = "http://127.0.0.1:8000/admin/detalleVehiculo/"+data;
      //console.log(data)
    }
    var redireccionar_descargar_pdf_cargo = function(data){
      window.location.href = "http://127.0.0.1:8000/admin/asignar_vehiculos/"+data;
      //console.log(data)
    }
    var obtener_data_detalles = function(tbody,table){
      $(tbody).on("click","button.detallesbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        //console.log(data.id_vehiculo);
        redireccionar_detalles(data.id_vehiculo)
         
      }); 
    }
    var editar_vehiculo = function(tbody,table){
      $(tbody).on("click","button.Editarbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        var id_vehiculo = $('#id_vehiculo_edicion').val(data.id_vehiculo),
         dominio = $('#id_editar_vehiculo_asignado').val(data.dominio),
         fecha = $('#id_fecha_edicion').val(data.fecha),
         fecha = $('#id_responsable_edicion').val(data.responsable),
         fecha = $('#id_afectado_edicion').val(data.afectado),
         observaciones = $('#id_observaciones_edicion').val(data.observaciones),
         detalle = $('#id_detalle').val(data.id_detalle);

      
         
      }); 
    }
    var descaargar_vehiculo = function(tbody,table){
      $(tbody).on("click","button.Descargarbtn",function(){
        //console.log('ascendente')
        var data = table.row($(this).parents("tr")).data();
        redireccionar_descargar_pdf_cargo(data.id_detalle);      
         
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

////Alta
$("#id_afectado").select2({
  dropdownParent: $("#select"),
  placeholder:"Seleccione Afectado",
  allowClear: true,
  minimumInputLength: 3,
  //language: "es",
  type: "GET",
  ajax: {
    dataType: 'json',
    url: '{{ url("admin/posibles_afectados") }}',
    delay: 250,
    data: function (params) {
      //console.log(params)
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
                  text: item.destino,
                  id: item.id_destino+'/'+item.nivel,
                 // descripcion:descripcion
              }
          })
      };
  },
  cache: true,

    },
});
////Edicion
$("#id_afectado_edicion").select2({
  dropdownParent: $("#select_edicion"),
  placeholder:"Seleccione Afectado",
  allowClear: true,
  minimumInputLength: 3,
  //language: "es",
  type: "GET",
  ajax: {
    dataType: 'json',
    url: '{{ url("admin/posibles_afectados") }}',
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
              return {
                  text: item.destino,
                  id: item.id_destino+'/'+item.nivel,
                 // descripcion:descripcion
              }
          })
      };
  },
  cache: true,

    },
});

////Vehiculos

  $("#id_vehiculo").select2({
    dropdownParent: $("#select"),
    placeholder:"Seleccione Vehiculo",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ url("/admin/vehiculos_select_vehiculos_disponibles") }}',
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
  function getComboA(id_select) {
      var value = id_select.value; 
      var mandatarios = value.split('/');
      if(mandatarios[0] == 5){
      
        $('#div_mandatario1').css('display','block')
        $('#div_separacion1').css('display','none')
      }else{
        $('#div_mandatario1').css('display','none')
        $('#div_separacion1').css('display','block')
      }
  } 
</script>

<style>
.ProbandoColor{
  background-color: #29F000;
  border-radius: 30px;
}
.ProbandoColor1{
  background-color: #F7EB03;
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

