<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-desktop"></i>
                <p>Asignación de Equipos</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="far fa-save"></i>
                <p>Backup</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-file-invoice"></i>
                <p>Inventario TI</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="far fa-id-badge"></i>
                <p>Licencias</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-laptop-code"></i>
                <p>Mantenimientos</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-user-tie"></i>
                <p>Matriz de Usuarios y Criticidad</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-users"></i>
                <p>Usuarios</p>
            </a>
            
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#" class="nav-link">
            <i class="fas fa-id-card"></i>
                <p>Perfiles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-search-plus"></i>
                <p>
                    Soporte
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a data-toggle="tab" href="#" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Realizar Solicitud</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes de Soporte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#" class="nav-link">
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
                    <div id="principal" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-info">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Solicitudes Realizadas
                                        </h3>
                                    </div>
                                </div>
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