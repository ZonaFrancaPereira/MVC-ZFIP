<?php
require_once "configuracion.php";
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a data-toggle="tab" href="#asignacion_equipos" class="nav-link">
                <i class="fas fa-desktop"></i>
                <p>Asignación de Equipos</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#contraseñas_marcar" class="nav-link">
                <i class="far fa-save"></i>
                <p>Contraseñas</p>
            </a>
        </li>

        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
                <i class="far fa-save"></i>
                <p>
                    Backup
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a data-toggle="tab" href="#principal_backup" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Principal</p>
                    </a>
                </li>
                <?php
                $cargoTi = [1, 2];
                if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargoTi)):
                ?>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#backup" class="nav-link">
                            <i class="nav-icon far fa-question-circle"></i>
                            <p>Asignar Ruta</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a data-toggle="tab" href="#verificar_backup" class="nav-link">
                            <i class="nav-icon far fa-question-circle"></i>
                            <p>Realizar Verificacion</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>


        <li class="nav-item">
            <a data-toggle="tab" href="#actualizacion_pw" class="nav-link">
                <i class="fas fa-key"></i>
                <p>Contraseñas</p>
            </a>
        </li>
                <?php
                $cargoTi = [1, 2];
                if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargoTi)):
                ?>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
                <i class="fas fa-print"></i>
                <p>
                    Consumibles
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a data-toggle="tab" href="#principal_consumibles" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Principal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#impresoras" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Impresoras</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="tab" href="#consumibles" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Registrar Consumible</p>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>


        <li class="nav-item">
            <a data-toggle="tab" href="#criticidad" class="nav-link">
                <i class="fas fa-user-tie"></i>
                <p>Matriz de Usuarios y Criticidad</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#inventario" class="nav-link">
                <i class="fas fa-file-invoice"></i>
                <p>Inventario TI</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#licencias" class="nav-link">
                <i class="far fa-id-badge"></i>
                <p>Licencias</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
                <i class="fas fa-laptop-code"></i>
                <p>
                    Mantenimientos
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a data-toggle="tab" href="#mantenimientos" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Principal</p>
                    </a>
                </li>
                <?php
                $cargoTi = [1, 2];
                if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargoTi)):
                ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#equipo" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Equipos de computo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#general" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>General</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#impresora" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Impresora</p>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#perfiles" class="nav-link">
                <i class="fas fa-id-card"></i>
                <p>Perfiles</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
                <i class="nav-icon fas fa-search-plus"></i>
                <p>
                    Soporte
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a data-toggle="tab" href="#principal_soporte" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Principal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#realizar_solicitud" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Realizar Solicitud</p>
                    </a>
                </li>
                <?php
                $cargoTi = [1, 2];
                if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargoTi)):
                ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#solicitudes_finalizadas" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes Finalizadas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#solicitudes_soporte" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes de Soporte</p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#usuarios" class="nav-link">
                <i class="fas fa-users"></i>
                <p>Usuarios</p>
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
<?php
if ($_SESSION["ti"] == "off") {
  echo '<script>
    window.location = "inicio";
  </script>';
  exit();  // Detiene la ejecución después del redireccionamiento
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
