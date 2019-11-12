$(document).ready(function(){
    $('#limpiar').click(function() {
      $(document).find('#listada_de_vehiculos').empty();
      $("#listada_de_vehiculos").dataTable().fnDestroy();
      $("#id_afectado").empty();
      $('#id_afectado').val('');
      $('#id_anio').val('');
      $('#id_marca').val('');
      $('#id_dominio').val('');
      $('#id_identificacion').val('');
        });
    $('#btnBuscar').on('click',function(){ 

      $("#listada_de_vehiculos").dataTable().fnDestroy();

      var afectado = $('#id_afectado').val();
      var anio = $('#id_anio').val();
      var marca = $('#id_marca').val();
      var dominio = $('#id_dominio').val();
      var identificacion = $('#id_identificacion').val();
      
      $.ajax({
        url: '/admin/recargaBuscador',
        data:{

          "_token": $('meta[name="csrf-token"]').attr('content'),
          "afectado":afectado,
          "anio":anio,
          "marca":marca,
          "dominio":dominio,
          "identificacion":identificacion,
        },
        type: "POST",
        success: function(r){
          $('#tablaResultado').html(r);
        },
        'error': function(data){
          swal("Error!!", "no hay datos que coincidan en la busqueda", "error");
        },

      });
    });
  });

