<?php
require_once "configuracion.php";


if ($_SESSION["ConsultarBascula"] == "NULL") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="#panelbascula" class="active nav-link">
                <i class="fas fa-desktop"></i>
                <p>Panel de Control</p>
            </a>
        </li>

        <li class="nav-item">
            <a data-toggle="tab" href="#formbascula" class="nav-link">
                <i class="far fa-save"></i>
                <p>Crear Pesaje</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#consultarpesaje" class="nav-link">
                <i class="fas fa-laptop-code"></i>
                <p>Consultar Pesajes</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#formclientes" class="nav-link">
                <i class="fas fa-file-invoice"></i>
                <p>Clientes</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
                <i class="fas fa-user-tie"></i>
                <p>Configuración</p>
            </a>
        </li>
    </ul>
</nav>
</div>
<!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">
                    <!-- /.PANEL PRINCIPAL PARA MOSTRAR LAS CAJAS SUPERIORES E INFORMACIÓN DE BASCULAS -->

                    <div id="panelbascula" class="active tab-pane">
                        <?php require "operaciones/cajas_op.php"; ?>
                    </div>
                    <!-- /. FORMULARIO PARA INGRESAR NUEVO PESAJE -->
                    <div id="formbascula" class="tab-pane">
                        <?php require "operaciones/formulario_pesaje.php"; ?>
                    </div>
                    <!-- /. CONSULTAR PESAJE Y SUS ESTADOS -->
                    <div id="consultarpesaje" class="tab-pane">
                        <?php require "operaciones/consultar_pesaje.php"; ?>
                    </div>
                    <!-- /. Clientes -->
                    <div id="formclientes" class="tab-pane">
                        <?php require "operaciones/clientes_pesaje.php"; ?>
                        <!-- ACCIONES PHP PARA ELIMINIAR CLIENTE  -->
<?php
$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>

</html>