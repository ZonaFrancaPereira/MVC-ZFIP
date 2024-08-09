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
            <a data-toggle="tab" href="#backup" class="nav-link">
                <i class="far fa-save"></i>
                <p>Backup</p>
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
                <li class="nav-item">
                    <a data-toggle="tab" href="#impresora" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Impresora</p>
                    </a>
                </li>
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
            </ul>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#criticidad" class="nav-link">
                <i class="fas fa-user-tie"></i>
                <p>Matriz de Usuarios y Criticidad</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#usuarios" class="nav-link">
                <i class="fas fa-users"></i>
                <p>Usuarios</p>
            </a>
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
                <li class="nav-item">
                    <a data-toggle="tab" href="#solicitudes_soporte" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes de Soporte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#solicitudes_finalizadas" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes Finalizadas</p>
                    </a>
                </li>
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

                    <div id="inventario" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/inventario.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="usuarios" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/usuarios.php"; ?>
                            </div>
                            <?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>
                        </div>
                    </div>
                    
                    <div id="backup" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/backup.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="asignacion_equipos" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/asignacion_equipos.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="mantenimientos" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/mantenimientos.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="equipo" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/equipo.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="impresora" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/impresora.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="general" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/general.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="licencias" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/licencias.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="criticidad" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/criticidad.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="principal_soporte" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/principal_soporte.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="realizar_solicitud" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/soporte.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="solicitudes_soporte" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/solicitudes_soporte.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="solicitudes_finalizadas" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/solicitudes_finalizadas.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div id="perfiles" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "ti/perfiles.php"; ?>
                                <?php
                                $borrarPerfil = new ControladorPerfiles();
                                $borrarPerfil->ctrBorrarPerfil();
                                ?>
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