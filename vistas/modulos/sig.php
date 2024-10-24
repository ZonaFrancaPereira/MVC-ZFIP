<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#" class="active nav-link">
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
      <a data-toggle="tab" href="#panelsig" class="active nav-link">
        <i class="fas fa-desktop"></i>
        <p>Panel de Control</p>
      </a>
    </li>
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
        <li class="nav-item">
          <a data-toggle="tab" href="#acciones_abiertas_vencidas" class="nav-link">
            <i class="nav-icon far fa-question-circle"></i>
            <p>Acciones Abiertas Vencidas</p>
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
        <li class="nav-item">
      <a data-toggle="tab" href="" class="nav-link">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
          AREAS
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#seguimiento" class="nav-link">
            <i class="fas fa-desktop"></i>
              <p>Seguimiento ACPM</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#tecnica" class="nav-link">
              <i class="fas fa-tools"></i>
              <p>Técnica</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#sig" class="nav-link">
              <i class="fas fa-tools"></i>
              <p>Sig</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#gestion_administrativa" class="nav-link">
              <i class="fas fa-users"></i>
              <p>Gestión Administrativa</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#gestion_contable" class="nav-link">
              <i class="fas fa-file-csv"></i>
              <p>Gestión Contable</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#gestion_juridica" class="nav-link">
              <i class="fas fa-gavel"></i>
              <p>Gestión Jurídica</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#tecnologia_informatica" class="nav-link">
              <i class="fas fa-laptop-code"></i>
              <p>Gestión de Tecnología e Informática</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#operaciones" class="nav-link">
              <i class="fas fa-clipboard-check"></i>
              <p>Operaciones</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#gerencia" class="nav-link">
              <i class="fas fa-user-shield"></i>
              <p>Gerencia</p>
            </a>
          </li>
          <li class="nav-item" name="">
            <a data-toggle="tab" href="#seguridad" class="nav-link">
              <i class="fas fa-user-shield"></i>
              <p>Seguridad</p>
            </a>
          </li>
        </ul>
    </li>
      </ul>
    </li>
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

        <div id="panelsig" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/panel_control_usuarios.php"; ?>
              </div>
            </div>
          </div>

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
          <div id="acciones_abiertas_vencidas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/acciones_abiertas_vencidas.php"; ?>
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

          <div id="tecnica" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/tecnica.php"; ?>
              </div>
            </div>
          </div>

          <div id="sig" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/sig.php"; ?>
              </div>
            </div>
          </div>

          <div id="gestion_administrativa" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/gestion_administrativa.php"; ?>
              </div>
            </div>
          </div>

          <div id="gestion_contable" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/gestion_contable.php"; ?>
              </div>
            </div>
          </div>

          <div id="gestion_juridica" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/gestion_juridica.php"; ?>
              </div>
            </div>
          </div>

          <div id="tecnologia_informatica" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/tecnologia_informatica.php"; ?>
              </div>
            </div>
          </div>

          <div id="operaciones" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/operaciones.php"; ?>
              </div>
            </div>
          </div>

          <div id="gerencia" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/gerencia.php"; ?>
              </div>
            </div>
          </div>

          <div id="seguridad" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/seguridad.php"; ?>
              </div>
            </div>
          </div>

          <div id="seguimiento" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/seguimiento.php"; ?>
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