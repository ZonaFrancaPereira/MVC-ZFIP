<?php
  date_default_timezone_set('America/Bogota');
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PLATAFORMA ZFIP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">
  <!--=====================================
  vistas/PLUGINS DE CSS
  ======================================-->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
  <!-- Switch Check -->
  <link href="vistas/bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Elimina esta línea si no quieres usar el CSS predeterminado -->
<link rel="stylesheet" href="vistas/plugins/cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="vistas/dist/css/acpm.css">
  
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
   <!-- Control Sidebar -->
   <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script src="vistas/plugins/jquery/signature_pad.js"></script>

  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="vistas/plugins/chart.js/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <!-- Sparkline -->
  <script src="vistas/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="vistas/plugins/moment/moment.min.js"></script>
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="vistas/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="vistas/dist/js/pages/dashboard.js"></script>
  <!-- Select2 -->
  <script src="vistas/plugins/select2/js/select2.full.min.js"></script>
   <!-- iCheck 1.0.1 -->
   <script src="vistas/plugins/iCheck/icheck.min.js"></script>
  <!-- Swith Check -->
  <script src="vistas/bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
  <!-- Bootstrap Switch -->
<script src="vistas/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- Bootstrap Switch -->
<script src="vistas/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


  <!-- Initialize tooltips -->
  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <!-- DataTables  & Plugins -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/plugins/jszip/jszip.min.js"></script>
  <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Summernote -->
<script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<!-- Estilos para Select2 -->
<style>
    .select2-search__field {
        color: black !important;
    }
    .select2-selection__choice {
        background-color: #007bff !important;
        color: white !important;
        font-weight: bold;
    }
    .select2-dropdown {
        background-color: white !important;
        color: black !important;
    }
</style>


<!--=====================================
CUERPO DOCUMENTO
======================================-->
<?php

require_once __DIR__ . '/../extensiones/vlucas/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();




  
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    echo '<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";
   
   

    /*=============================================
    CONTENIDO
    =============================================*/
    if (DEBUG) {
      if (!strpos($_SERVER["REQUEST_URI"], '&')) {
        if (!isset($_GET["ruta"])) {
          $_GET["ruta"] = str_replace("/", "", $_SERVER['PATH_INFO']);
        } else {
          $_GET["ruta"] = "inicio";
        }

        if ($_GET["ruta"] == "") {

          $_GET["ruta"] = "inicio";
        }
      }
    }


    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "perfil_usuario" ||
        $_GET["ruta"] == "ti" ||
        $_GET["ruta"] == "soporte" ||
        $_GET["ruta"] == "perfiles" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "operaciones" ||
        $_GET["ruta"] == "formulario_pesaje" ||
        $_GET["ruta"] == "contabilidad" ||
        $_GET["ruta"] == "panel_contabilidad" ||
        $_GET["ruta"] == "notificacion" ||
        $_GET["ruta"] == "sig" ||
        $_GET["ruta"] == "sadoc" ||
        $_GET["ruta"] == "acpm" ||
        $_GET["ruta"] == "tecnica" ||
        $_GET["ruta"] == "administrativa" ||
        $_GET["ruta"] == "gh" ||
        $_GET["ruta"] == "juridico" ||
        $_GET["ruta"] == "acciones_verificacion" ||
        $_GET["ruta"] == "salir"

      ) {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        include "modulos/404.php";
      }
    } else {

      include "modulos/inicio.php";
    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';
  } else {
    echo '<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    ';
    include "modulos/login.php";
  }

  ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/js/perfiles.js"></script>
  <script src="vistas/js/ti.js"></script>
  <script src="vistas/js/op.js"></script>
  <script src="vistas/js/clientes.js"></script>
  <script src="vistas/js/contabilidad.js"></script>
  
  <script src="vistas/js/sadoc.js"></script>
  <script src="vistas/js/tecnica.js"></script>
  <script src="vistas/js/juridico.js"></script>
  <script src="vistas/js/backup.js"></script>
  <script src="vistas/js/consumibles.js"></script>
  <script src="vistas/js/sig.js"></script>
  <script src="vistas/js/administrativa.js"></script>
  
  <script>


$(document).ready(function() {
    $("table.display").DataTable({

"language":{
  "sProcessing":     "Procesando...",
  "sLengthMenu":     "Mostrar _MENU_ registros",
  "sZeroRecords":    "No se encontraron resultados",
  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sSearch":         "Buscar:",
  "sInfoThousands":  ",",
  "sLoadingRecords": "Cargando...",
  "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
  },
  "oAria": {
    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
    "copy": "Copiar",
    "colvis": "Visibilidad"
  }
},
responsive:"true",
dom:"Bfrtilp",


"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],



"order":[[0,'desc']],
autoWidth: true

});

  });


 
</script>

<script>
  
    $(function() {
    /*=============================================
     Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
     =============================================*/
    $("#adicional").on('click', function() {
      $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila

    });
    /*=============================================
    Evento que selecciona la fila y la elimina 
    =============================================*/
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila


    });
  });
  
  $(function() {
    /*=============================================
     Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
     =============================================*/
    $("#adicional2").on('click', function() {
      $("#tabla2 tbody tr:eq(0)").clone().removeClass('fila-fija2').appendTo("#tabla2");
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila

    });
    /*=============================================
    Evento que selecciona la fila y la elimina 
    =============================================*/
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila


    });
  });
  $(function() {
    /*=============================================
     Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
     =============================================*/
    $("#adicional3").on('click', function() {
      $("#tabla3 tbody tr:eq(0)").clone().removeClass('fila-fija3').appendTo("#tabla3");
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila

    });
    /*=============================================
    Evento que selecciona la fila y la elimina 
    =============================================*/
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila


    });
  });
</script>


<script>
    function handleRadioChange() {
        const memberInput = document.getElementById('memberInput');
        const radioMembers = document.getElementById('radioMembers');

        // Verifica si "Sólo Miembros de un Proceso" está seleccionado
        if (radioMembers.checked) {
            memberInput.style.display = 'block'; // Mostrar el input
        } else {
            memberInput.style.display = 'none'; // Ocultar el input
        }
    }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Función para restaurar una pestaña activa
    function restoreActiveTab(storageKey, selector) {
      var activeTab = localStorage.getItem(storageKey);
      if (activeTab) {
        $(selector + ' a[href="' + activeTab + '"]').tab('show');
      }
    }

    // Restaurar la pestaña activa de nivel principal
    restoreActiveTab('activeTab', '.nav-pills');

    // Restaurar las pestañas activas de nivel secundario
    restoreActiveTab('activeSubTab', '.tab-content .nav-pills');

    // Guardar la pestaña activa de nivel principal
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
      var tabId = $(e.target).attr('href');
      if ($(e.target).closest('.nav-pills').length) {
        // Es una pestaña de nivel principal
        localStorage.setItem('activeTab', tabId);
      } else {
        // Es una pestaña secundaria
        localStorage.setItem('activeSubTab', tabId);
      }
    });
  });
</script>

</body>

</html>