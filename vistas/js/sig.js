$(document).ready();

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

var tablaAprobar = $("#tabla-aprobar-sig").DataTable({
    "ajax": {
        "url": "ajax/datatable-acpm.ajax.php",
        "type": "POST",
        "data": function (d) {
            d.especifico = "aprobar";
            console.log("Valor de específico:", d.especifico);
        },
        "dataSrc": "data"
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
    responsive: true,
    dom: "Bfrtilp",
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    "order": [[0, 'desc']],
    autoWidth: true
});

var tablaAbierta = $("#tabla-abierta-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "abierta";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaProceso= $("#tabla-proceso-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "proceso";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaCerrada= $("#tabla-cerrada-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "cerrada";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaRechazada= $("#tabla-rechazada-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "rechazada";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaAceptar= $("#tabla-aceptar-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "aceptar";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaTecnica= $("#tabla-tecnica-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "tecnica";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaSig= $("#tabla-sig-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "sig";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaAdministrativa= $("#tabla-administrativa-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "administrativa";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaContable= $("#tabla-contable-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "contable";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaJuridica= $("#tabla-juridica-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "juridica";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaInformatica= $("#tabla-informatica-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "informatica";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaOperaciones= $("#tabla-operaciones-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "operaciones";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaGerencia= $("#tabla-gerencia-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "gerencia";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

var tablaSeguridad= $("#tabla-seguridad-sig").DataTable({
  "ajax": {
      "url": "ajax/datatable-acpm.ajax.php",
      "type": "POST",
      "data": function (d) {
          d.especifico = "seguridad";
          console.log("Valor de específico:", d.especifico);
      },
      "dataSrc": "data"
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
  responsive: true,
  dom: "Bfrtilp",
  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  "order": [[0, 'desc']],
  autoWidth: true
});

$(document).ready(function() {
  $('#estado_acpm').on('change', function() {
      if ($(this).val() === 'Rechazada') {
          $('#motivo_rechazo_container').show();
      } else {
          $('#motivo_rechazo_container').hide();
      }
  });
});
   // Abre el modal y establece el ID en el formulario
   $('#modal-aprobar').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id_consecutivo = button.data('id'); // Extrae el ID del atributo data-id

    var modal = $(this);
    modal.find('#id_consecutivo').val(id_consecutivo); // Establece el ID en el campo oculto del formulario
});


$('#modal-success').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id_acpm_fk = button.data('id_acpm_fk'); // Extract info from data-* attributes

  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);

  modal.find('.modal-body #id_acpm_fk').val(id_acpm_fk);
});

$('#modal-unificado').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id_acpm_fk_sig1 = button.data('id_acpm_fk_sig1'); // Extrae la información desde data-id_acpm_fk_sig1

  // Actualiza el contenido del modal con el ID capturado
  var modal = $(this);
  modal.find('.modal-body #id_acpm_fk_sig1').val(id_acpm_fk_sig1);
});

$('#modal-modificar').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id_acpm_fk1 = button.data('id_acpm_fk1'); // Extract info from data-* attributes

  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);

  modal.find('.modal-body #id_acpm_fk1').val(id_acpm_fk1);
});

$(document).ready(function () {
  $("#accion_acpm").change(function () {
      var selectedAction = $(this).val();
      if (selectedAction === "eficacia") {
          $("#seccion-eficacia").show();
          $("#seccion-rechazo").hide();
      } else if (selectedAction === "rechazo") {
          $("#seccion-eficacia").hide();
          $("#seccion-rechazo").show();
      } else {
          $("#seccion-eficacia, #seccion-rechazo").hide();
      }
  });
});