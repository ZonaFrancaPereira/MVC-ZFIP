<?php
require_once "configuracion.php";
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="fas fa-desktop"></i>
                <p>Asignación de Equipos</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="far fa-save"></i>
                <p>Backup</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="fas fa-file-invoice"></i>
                <p>Inventario TI</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="far fa-id-badge"></i>
                <p>Licencias</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="fas fa-laptop-code"></i>
                <p>Mantenimientos</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="fas fa-user-tie"></i>
                <p>Matriz de Usuarios y Criticidad</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="usuarios" class="nav-link">
            <i class="fas fa-users"></i>
                <p>Usuarios</p>
            </a>
            
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="" class="nav-link">
            <i class="fas fa-id-card"></i>
                <p>Perfiles</p>
            </a>
        </li>
        <li class="nav-item">
            <a  data-toggle="tab" href="#principal_soporte" class="nav-link">
                <i class="nav-icon fas fa-search-plus"></i>
                <p>
                    Soporte
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a data-toggle="tab" href="#realizar_solicitud" class="nav-link">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>Realizar Solicitud</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>Solicitudes de Soporte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="" class="nav-link">
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
                    <!-- /.PANEL PRINCIPAL DE SOLICITUDES DE SOPORTE -->
                    <div id="principal_soporte" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-info">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Solicitudes Realizadas
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Descripción de la Solicitud</th>
                                                        <th>Fecha</th>
                                                        <th>Escala de Urgencia</th>
                                                        <th>Solución</th>
                                                        <th>Fecha Solución</th>
                                                        <th>Usuario quien da respuesta</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <tr style="text-align:center">
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td>6</td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-info">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-bullhorn mr-2"></i>
                                            Escala de Urgencia
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-danger text-center">
                                                    <h4 class="mb-0">1</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-danger">
                                                    <p class="mb-0">Urgente: se tendrá máximo un día para ser atendidas</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-warning text-center">
                                                    <h4 class="mb-0">2</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-warning">
                                                    <p class="mb-0">Urgencia media: tendrán 2 días para ser cerradas</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-success text-center">
                                                    <h4 class="mb-0">3</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-success">
                                                    <p class="mb-0">Prioridad baja: tendrán 4 días para su cierre</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-info">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Respuesta
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert bg-danger">
                                            <h5 class="mb-3"><i class="icon fas fa-ban"></i> Urgente!</h5>
                                            <p>Solicitudes que requieren atención inmediata debido a que afectan significativamente la productividad del proceso y pueden causar interrupciones graves si no se abordan de inmediato.</p>
                                        </div>
                                        <div class="alert bg-warning">
                                            <h5 class="mb-3"><i class="icon fas fa-info"></i> Urgencia media!</h5>
                                            <p>Solicitudes que son importantes para mantener la eficiencia del proceso y que, si no se atienden oportunamente, podrían generar problemas a medio plazo.</p>
                                        </div>
                                        <div class="alert bg-success">
                                            <h5 class="mb-3"><i class="icon fas fa-exclamation-triangle"></i> Prioridad baja!</h5>
                                            <p>Solicitudes que tienen cierta importancia pero que no tienen un impacto inmediato en la productividad del proceso. Se pueden abordar en un plazo razonable sin causar grandes inconvenientes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.FORMULARIO PARA REALIZAR SOLICITUD DE SOPORTE -->
                    <div id="realizar_solicitud" class="tab-pane">
                        <div class="card card-custom">
                            <div class="card-header bg-warning">
                                <center>
                                    <h3 class="card-title">¡Haz tu Solicitud de Soporte Aquí!</h3>
                            </div>
                            <form id="soporte_ti" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3"  >
                                            <label for="correo">Correo</label>
                                            <input list="correo_soporte_browsers" class="form-control" value="<?php echo $_SESSION['correo_usuario'] ?>" id="correo_soporte" name="correo_soporte" placeholder="Correo" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3" >
                                            <label for="id_usuario_soporte">id usuario</label>
                                            <input type="text" class="form-control" id="id_usuario_soporte" value="<?php echo $_SESSION['id'] ?>" name="id_usuario_soporte" placeholder="ID de Usuario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3"  >
                                            <label for="usuario_soporte">Nombre de Usuario</label>
                                            <input type="text" class="form-control" id="usuario_soporte" value="<?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos_usuario'] ?>" name="usuario_soporte" placeholder="Nombre de Usuario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3"  >
                                            <label for="proceso_soporte">Proceso</label>
                                            <input type="text" class="form-control" id="proceso_soporte" value="<?php echo $_SESSION['nombre_proceso'] ?>" name="proceso_soporte" placeholder="Proceso" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="textarea">Descripción de la solicitud</label>
                                            <textarea class="form-control" id="descripcion_soporte" name="descripcion_soporte" rows="3" placeholder="Descripción"></textarea>
                                        </div>
                                    </div>                <br>
                                    <div class="col-md-12">
                                        <div id="actions">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                                    <input type="file" class="btn btn-success col" id="imagenes_soporte" name="imagenes_soporte">
                                                    <button type="submit" class="btn btn-primary col start" hidden>
                                                        <i class="fas fa-upload"></i>
                                                        <span>Start upload</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning col cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancelar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-outline-warning btn-block" id="enviar_soporte" name="enviar_soporte"><i class="fas fa-paper-plane"></i>Enviar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>