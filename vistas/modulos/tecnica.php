<?php
require_once "configuracion.php";
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                    <a data-toggle="tab" href="#principal_tecnica" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Principal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#soporte_tecnica" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Realizar Solicitud</p>
                    </a>
                </li>

                <?php if (isset($_SESSION["id_proceso_fk"]) && $_SESSION["id_proceso_fk"] == 14): ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#finalizadas_tecnica" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes Finalizadas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#solicitudes_tecnica" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes de Soporte</p>
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

                <div id="principal_tecnica" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "tecnica/principal_tecnica.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="soporte_tecnica" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "tecnica/soporte_tecnica.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="finalizadas_tecnica" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "tecnica/finalizadas_tecnica.php"; ?>
                            </div>
                        </div>
                    </div>

                    <div id="solicitudes_tecnica" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <?php require "tecnica/solicitudes_tecnica.php"; ?>
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