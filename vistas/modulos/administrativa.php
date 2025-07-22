<?php
require_once "configuracion.php";
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#solicitudes_usuario" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Principal</p>
            </a>
        </li>
        <?php
        $aprovar = [1, 4, 6, 7, 8, 12, 19];
        if (in_array($_SESSION["id_cargo_fk"], $aprovar)):
        ?>
            <li class="nav-item">
                <a data-toggle="tab" href="#principal_administrativa" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Aprobar Solicitudes</p>
                </a>
            </li>
        <?php endif; ?>

        <?php
        $admin = [5, 6];
        if (in_array($_SESSION["id_cargo_fk"], $admin)):
        ?>

            <li class="nav-item">
                <a data-toggle="tab" href="#usuarios_administrativa" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#solicitudes_aprobadas" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>Solicitudes Aprobadas</p>
                </a>
            </li>
        <?php endif; ?>
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

                    <div id="usuarios_administrativa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "administrativa/usuarios_administrativa.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="principal_administrativa" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "administrativa/principal_administrativa.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="solicitudes_usuario" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "administrativa/solicitudes_usuario.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="solicitudes_aprobadas" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "administrativa/solicitudes_aprobadas.php"; ?>
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