@extends('plantilla')

@section('seccion')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

<div class="panel panel-success">

  <div class="panel panel-heading ">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#miModalSiniestro"> <i class="glyphicon glyphicon-plus"></i> Nuevo Siniestro</button>  
  </div>
  {{-- Modales --}}
  @extends('vehiculos/siniestros/modal_alta_siniestro')
  @extends('vehiculos/siniestros/modal_edicion_siniestro')
  @extends('vehiculos/modales/modal_pdf_siniestro')



    <div class="col-md-12 panel panel-body">
      <table id="lista_siniestros" tableStyle="width:auto"  class=" table table-striped table-hover table-condensed table-bordered">
        <thead>
          <tr>
            <th>N° Interno</th>

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

      var table = $('#lista_siniestros').DataTable({
            "Sdom": 'Blrtip',
           // "pageLength": 5,
           "bsearching": true,
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
            "ajax":{"url":"{{ url('admin/total_siniestros') }}","dataType": "JSON"},
            "columns": [
                {data: 'numero_de_identificacion'},
                {data: 'afectado_siniestro'},
                {data: 'lugar_siniestro'},
                {data: 'fecha_siniestro',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
                {data: 'lesiones_siniestro',
                render: function (data, type, row) {
                 // return data
                  if (data == "0") {
                    return 'No';
                  }else {
                    return 'Si';
                  }
                    }
              },
                {data: 'descripcion_siniestro'},
                {data: 'fecha_presentacion',

                  "type": "date ",
                  "render":function (value) {
                  if (value === null) return "";
                  var data = value.split('-');
                  return (data[2] + "/" + data[1] + "/" + data[0])}
                },
                {data: 'observaciones_siniestro'},
                 {"defaultContent": '<button title="detalles" class="detallesbtn btn btn-info btn-sm"><span aria-hidden="true" class="glyphicon glyphicon-eye-open"></span></button><button data-toggle="modal" data-target="#miModalSiniestroEdicion" title="mas detalles"  class=" Editarbtn btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button><button data-toggle="modal"   title="Descargar PDF"  class="Descargarbtn btn btn-danger btn-sm"><span class="fa fa-file-pdf-o"></span></button>'},
            ],
            "language": Lenguaje_Español,
        });
        obtener_data_detalles("#lista_siniestros",table);
        editar_vehiculo("#lista_siniestros",table);
        obtener_data_mas_detalles("#lista_siniestros",table);
    });
/*data-target="#miModalPdfSiniestro"*/
    var redireccionar_detalles = function(data){
      window.location.href = "http://127.0.0.1:8000/admin/detalleVehiculo/"+data;
      //console.log(data)
    }

    var obtener_data_detalles = function(tbody,table){
      $(tbody).on("click","button.detallesbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        redireccionar_detalles(data.id_vehiculo)
         
      }); 
    }
    var editar_vehiculo = function(tbody,table){
      $(tbody).on("click","button.Editarbtn",function(){
        var data = table.row($(this).parents("tr")).data();
        console.log(data.id_siniestro)
        var id_vehiculo = $('#id_vehiculo_siniestro').val(data.id_vehiculo),
         lesiones_siniestro = $('#id_lesionados').val(data.lesiones_siniestro),
         identificacion = $('#id_identificacion_interna').val(data.numero_de_identificacion),
         fecha_siniestro = $('#id_fecha_siniestro').val(data.fecha_siniestro),
         fecha_presentacion = $('#id_fecha_presentacion').val(data.fecha_presentacion),
         lugar_siniestro = $('#id_lugar_siniestro').val(data.lugar_siniestro),
         observaciones = $('#id_observaciones_siniestro').val(data.observaciones_siniestro),
         descripcion_siniestro = $('#id_descripcion_siniestro').val(data.descripcion_siniestro),
         observaciones_siniestro = $('#id_observaciones_siniestro').val(data.observaciones_siniestro),
         siniestro_id = $('#id_siniestro').val(data.id_siniestro);
         
      }); 
    }



    function obtener_data_mas_detalles(tbody,table) {
     $(tbody).on("click","button.Descargarbtn",function(){
        var data = table.row($(this).parents("tr")).data();
       

       $.ajax({
          url: '/admin/detalle_pdf_siniestro',
          data:{

            "_token": $('meta[name="csrf-token"]').attr('content'),
            "id_siniestro" :data.id_siniestro,
          },
          type: "POST",
          success: function(r){
           $("#miModalPdfSiniestro").modal('show');
            $('#modalopen').html(r);
          },
          'error': function(data){
            $("#miModalPdfSiniestro").modal('hide');
            swal("Error!!", "no hay pdfs para descargar", "error");
          },

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
  $.fn.select2.defaults.set('language', 'es');



  $("#id_vehiculo").select2({
    dropdownParent: $("#select"),
    placeholder:"Seleccione Vehiculo",
    allowClear: true,
    minimumInputLength: 2,

    type: "GET",
    ajax: {
      dataType: 'json',
      url: '{{ url("/admin/vehiculos_select") }}',
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
  background-color: #FF0000;
  border-radius: 10px;

}
.ProbandoColor1{
  background-color: #00EA0D;
  color: #FFFFFF;
  border-radius: 10px;
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

