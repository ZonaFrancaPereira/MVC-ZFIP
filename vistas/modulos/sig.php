<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panelusuario" class="active nav-link">
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
      <a data-toggle="collapse" href="#acpmMenu" class="nav-link">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
          ACPM
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview collapse show" id="acpmMenu">
      <?php if (isset($_SESSION["id_cargo_fk"]) && $_SESSION["id_cargo_fk"] == 4): ?>
        <li class="nav-item">
          <a data-toggle="tab" href="#panelsig" class="active nav-link">
            <i class="fas fa-desktop"></i>
            <p>Panel de Control</p>
          </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a data-toggle="tab" href="#actividades_asignadas" class="nav-link">
            <i class="nav-icon far fa-check-circle"></i>
            <p>Actividades Asignadas</p>
          </a>
        </li>

        <?php
        $cargosPermitidos = [1, 3, 4, 6, 7, 8, 12, 14, 15, 19, 22];
        if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargosPermitidos)):
        ?>
          <li class="nav-item">
            <a data-toggle="tab" href="#acpm" class="nav-link">
              <i class="nav-icon fas fa-file-medical"></i>
              <p>
                Nueva ACPM
                <span class="right badge badge-success">Nueva</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
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
          <li class="nav-item">
            <a data-toggle="tab" href="#acciones_cerradas" class="nav-link">
              <i class="nav-icon far fa-check-circle"></i>
              <p>Acciones Cerradas</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#acciones_rechazadas" class="nav-link">
              <i class="nav-icon far fa-times-circle"></i>
              <p>Acciones Rechazadas</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#acciones_proceso" class="nav-link">
              <i class="nav-icon fas fa-sync-alt"></i>
              <p>Acciones en Proceso</p>
            </a>
          </li>
        <?php endif; ?>

        <?php if (isset($_SESSION["id_cargo_fk"]) && $_SESSION["id_cargo_fk"] == 4): ?>
          <li class="nav-item">
            <a data-toggle="tab" href="#aprobacion" class="nav-link">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                Aprobar ACPM
                <span class="right badge badge-danger">Urgente</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#aceptar_acpm" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Verificar ACPM
                <span class="right badge badge-danger">Urgente</span>
              </p>
            </a>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a data-toggle="tab" href="#manual_activos" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>Manual</p>
          </a>
        </li>
        <?php if (isset($_SESSION["id_cargo_fk"]) && $_SESSION["id_cargo_fk"] == 4): ?>
          <li class="nav-item">
            <a data-toggle="collapse" href="#areasMenu" class="nav-link">
              <i class="nav-icon fas fa-qrcode"></i>
              <p>
                Áreas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview collapse show" id="areasMenu">

              <li class="nav-item">
                <a data-toggle="tab" href="#tecnica" class="nav-link">
                  <i class="fas fa-tools"></i>
                  <p>Técnica</p>
                </a>
              </li>

              <li class="nav-item">
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

              <li class="nav-item">
                <a data-toggle="tab" href="#gestion_contable" class="nav-link">
                  <i class="fas fa-file-csv"></i>
                  <p>Gestión Contable</p>
                </a>
              </li>

              <li class="nav-item">
                <a data-toggle="tab" href="#gestion_juridica" class="nav-link">
                  <i class="fas fa-gavel"></i>
                  <p>Gestión Jurídica</p>
                </a>
              </li>

              <li class="nav-item">
                <a data-toggle="tab" href="#tecnologia_informatica" class="nav-link">
                  <i class="fas fa-laptop-code"></i>
                  <p>Gestión de Tecnología e Informática</p>
                </a>
              </li>

              <li class="nav-item">
                <a data-toggle="tab" href="#operaciones" class="nav-link">
                  <i class="fas fa-clipboard-check"></i>
                  <p>Operaciones</p>
                </a>
              </li>

              <li class="nav-item">
                <a data-toggle="tab" href="#gerencia" class="nav-link">
                  <i class="fas fa-user-shield"></i>
                  <p>Gerencia</p>
                </a>
              </li>

              <li class="nav-item">
                <a data-toggle="tab" href="#seguridad" class="nav-link">
                  <i class="fas fa-user-shield"></i>
                  <p>Seguridad</p>
                </a>
              </li>
            <?php endif; ?>

            </ul>
          </li>

    <li class="nav-item">
      <a data-toggle="collapse" href="#menuCodificacion" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
          Solicitudes Codificación
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview collapse show" id="menuCodificacion">
        <li class="nav-item">
          <a data-toggle="tab" data-target="#codificacion" class="nav-link">
            <i class="fas fa-file-signature"></i>
            <p>Realizar Solicitud</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-toggle="tab" data-target="#cod_realizada" class="nav-link">
            <i class="fas fa-check-circle"></i>
            <p>Solicitudes Realizadas</p>
          </a>
        </li>
        <?php if (isset($_SESSION["id_cargo_fk"]) && $_SESSION["id_cargo_fk"] == 4): ?>
          <li class="nav-item">
            <a data-toggle="tab" data-target="#cod_responder" class="nav-link">
              <i class="fas fa-reply"></i>
              <p>Responder Solicitud</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" data-target="#cod_terminadas" class="nav-link">
              <i class="fas fa-check-double"></i>
              <p>Solicitudes Terminadas</p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
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
          <!-- /.ACPM-->
          <div id="panelsig" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/panel_control_usuarios.php"; ?>
              </div>
            </div>
          </div>

          <div id="panelusuario" class="active tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/panel.php"; ?>
              </div>
            </div>
          </div>

          <div id="actividades_asignadas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/actividades_asignadas.php"; ?>
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
          <!-- /.FIN ACPM-->


          <!-- /.INICIO MODULO DE CODIFICACION --->
          <div id="codificacion" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/codificacion.php"; ?>
              </div>
            </div>
          </div>

          <div id="cod_realizada" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/cod_realizada.php"; ?>
              </div>
            </div>
          </div>



          <div id="cod_responder" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/cod_responder.php"; ?>
              </div>
            </div>
          </div>

          <div id="cod_terminadas" class="tab-pane">
            <div class="row">
              <div class="col-md-12">
                <?php require "sig/cod_terminadas.php"; ?>
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