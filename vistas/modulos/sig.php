<?php
require_once "configuracion.php";
?>
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panelsig" class="active nav-link">
        <i class="fas fa-desktop"></i>
        <p>Panel de Control</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="sadoc" class="nav-link">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
          SADOC
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a data-toggle="tab" href="" class="nav-link">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
          ACPM
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a data-toggle="tab" href="#acpm" class="nav-link ">
            <i class="nav-icon fas fa-file-medical"></i>
            <p>
              Nueva ACPM
              <span class="right badge badge-success">Nueva</span>
            </p>
          </a>
        </li>
        <li class="nav-item" name="verificacion">
          <a data-toggle="tab" href="#acciones_verificacion" class="nav-link">
            <i class="nav-icon fas fa-sync-alt"></i>
            <p>Acciones en Verificación</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" href="#acciones_abiertas" class="nav-link">
            <i class="nav-icon far fa-question-circle"></i>
            <p>Acciones Abiertas</p>
          </a>
        </li>
        <li class="nav-item" name="">
          <a data-toggle="tab" href="#acciones_cerradas" class="nav-link">
            <i class="nav-icon far fa-check-circle"></i>
            <p>Acciones Cerradas</p>
          </a>
        </li>
        <li class="nav-item" name="rechazadas">
          <a data-toggle="tab" href="#acciones_rechazadas" class="nav-link">
            <i class="nav-icon far fa-times-circle"></i>
            <p>Acciones Rechazadas</p>
          </a>
        </li>
        <li class="nav-item" name="proceso">
          <a data-toggle="tab" href="#acciones_proceso" class="nav-link">
            <i class="nav-icon fas fa-sync-alt"></i>
            <p>Acciones en Proceso</p>
          </a>
        </li>
         <!-- /.ESTA PARTE PERTENECE SOLO A SIG -->
      <li class="nav-item">
        <a data-toggle="tab" href="#aprobacion" class="nav-link ">
          <i class="nav-icon fas fa-question-circle"></i>
          <p>
            Aprobar ACPM
            <span class="right badge badge-danger">Urgente</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="tab" href="#aceptar_acpm" class="nav-link ">
          <i class="nav-icon fas fa-clipboard-check"></i>
          <p>
            Verificar ACPM
            <span class="right badge badge-danger">Urgente</span>
          </p>
        </a>
      </li>

        <li class="nav-item">
          <a data-toggle="tab" href="#manual_activos" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Manual
            </p>
          </a>

        </li>
      </ul>
</nav>

<?php

if ($_SESSION["ti"] == "off") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
</div>
<!-- /.sidebar -->
</aside>

<div class="content-wrapper">
  <div id="wrapper" class="toggled">
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content card">
          <div id="acpm" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acpm.php"; ?>
              </div>
            </div>
          </div>

          <div id="acciones_abiertas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_abiertas.php"; ?>
              </div>
            </div>
          </div>

          <div id="acciones_cerradas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_cerradas.php"; ?>
              </div>
            </div>
          </div>

          
          <div id="acciones_proceso" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_proceso.php"; ?>
              </div>
            </div>
          </div>

          
          <div id="acciones_rechazadas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_rechazadas.php"; ?>
              </div>
            </div>
          </div>

          
          <div id="acciones_verificacion" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_verificacion.php"; ?>
              </div>
            </div>
          </div>
         

          <div id="aceptar_acpm" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/aceptar_acpm.php"; ?>
              </div>
            </div>
          </div>

          <div id="aprobacion" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/aprobacion.php"; ?>
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>