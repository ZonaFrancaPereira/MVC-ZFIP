$(document).ready(function() {
    $("#similares").hide();
    $("#fuente").hide();
    $("#riesgos").hide();
    $("#correccion").hide();


    $("#nc_similar").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#similares").show();
      } else {
        $("#similares").hide();
      }
    });
    $("#fuente_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Otros") {
        $("#fuente").show();
      } else {
        $("#fuente").hide();
      }
    });
    $("#riesgo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#riesgos").show();
      } else {
        $("#riesgos").hide();
      }
    });
    $("#tipo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "AC" || seleccion === "AP") {
        $("#correccion").show();
      } else {
        $("#correccion").hide();
      }
    });
  });

  var tablaAcpm = $("#tabla-verificacion-sig").DataTable({
    "ajax": {
      "url": "ajax/datatable-acpm.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
      "type": "POST", // Método de solicitud POST
      "data": function (d) {
  
        // Puedes enviar parámetros adicionales si es necesario
        d.especifico = "acpm"; // Ejemplo de parámetro, ajusta según tu lógica
        console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data" // Nombre del objeto JSON que contiene los datos para DataTable
    },
    "deferRender": true,
    "serverSide": true,
    "retrieve": true,
    "processing": true,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
      }
    },
    responsive: "true",
    dom: "Bfrtilp",
  
  
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  
  
  
    "order": [[0, 'desc']],
    autoWidth: true
  
  });

  $('#modal-success').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_acpm_fk = button.data('id_acpm_fk'); // Extract info from data-* attributes

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('.modal-body #id_acpm_fk').val(id_acpm_fk);
  });

  var tablaAprobar = $("#tabla-aprobar-sig").DataTable({
    "ajax": {
      "url": "ajax/datatable-acpm.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
      "type": "POST", // Método de solicitud POST
      "data": function (d) {
  
        // Puedes enviar parámetros adicionales si es necesario
        d.especifico = "aprobar"; // Ejemplo de parámetro, ajusta según tu lógica
        console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data" // Nombre del objeto JSON que contiene los datos para DataTable
    },
    "deferRender": true,
    "serverSide": true,
    "retrieve": true,
    "processing": true,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
      }
    },
    responsive: "true",
    dom: "Bfrtilp",
  
  
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  
  
  
    "order": [[0, 'desc']],
    autoWidth: true
  
  });