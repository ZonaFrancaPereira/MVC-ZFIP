123
<?php

if ($_SESSION["perfiles"] == "off") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administrar Perfiles
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Perfiles
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <button type="button" class="btn bg-success" data-toggle="modal" data-target="#modal-perfil">
            Agregar Perfil
        </button>
        <div class="modal fade" id="modal-perfil">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Crear Perfil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- #INPUT PARA AGREGAR LA DESCRIPCION DEL PERFIL -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control input-lg" name="nuevoDescripcionPerfil" placeholder="Ejemplo: TI | Usuarios | Super Usuario" required>
                        </div>
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active " id="custom-tabs-one-home-tab" data-toggle="pill" href="#ti" role="tab" aria-controls="ti" aria-selected="true">TI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#sig" role="tab" aria-controls="sig" aria-selected="false">SIG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#ct" role="tab" aria-controls="ct" aria-selected="false">Contabilidad</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="ti" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A TI -->
                                <div class="card-header bg-teal">
                                    Configuraciones Tecnología e Informática.
                                </div>
                                <!-- DIV PARA CONTENER LAS OPCIONES  DE TI-->
                                <div class="pt-2 card">
                                    <!-- MODULO PARA GESTIONAR TODO LO RELACIONADO CON EL AREA DE TI, USUARIOS, PERFILES -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO GESTIÓN TI</h6>
                                    </div>

                                    <!-- Check USUARIOS -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smUsuarios" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar usuarios">Usuarios</label>
                                    </div>
                                    <!-- Check Perfiles -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar perfiles, es importante para limitar permisos dentro de la APP">Perfiles</label>
                                    </div>
                                    <br>
                                    <!-- MODULO PARA GESTIONAR LOS MANTENIMIENTOS DE LOS EQUIPOS TECNOLÓGICOS -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO MANTENIMIENTO DE RECURSOS TECNOLÓGICOS</h6>
                                    </div>
                                    <!-- Check Mantenimientos -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smMantenimientos" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar los mantenimientos de equipos y dispositivos de ZFIP">Mantenimientos</label>
                                    </div>
                                    <!-- Check Inventario TI -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smInventario" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar el inventario de recursos tecnológicos, incluidas licencias, dispositivos móviles y equipos de computo">Inventario TI (Asignación de equipos y licencias)</label>
                                    </div>
                                    <br>
                                    <!-- MODULO PARA GESTIONAR LOS SOPORTES TÉCNICOS -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO SOPORTE TÉCNICO</h6>
                                    </div>
                                    <!-- Check Solicitud de soporte TI -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smSolicitudSoporte" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para enviar solicitudes de soporte técnico al area de TI">Solicitud de Soporte TI</label>
                                    </div>
                                    <!-- Check CONSULTAR SOLICITUDES POR CADA USUARIO -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smConsultarSoporte" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar solicitudes de soporte técnico realizadas">Consultar Solicitudes de Soporte Técnico </label>
                                    </div>
                                    <!-- Check Administrador de soportes TI -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smAdminSoporte" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder solicitudes de soporte técnico a los usuarios">Administrador de Soportes TI</label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sig" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A SISTEMA INTEGRADO DE GESTIÓN SIG -->
                                <div class="card-header bg-success">
                                    Configuraciones Sistema Integrado de Gestión.
                                </div>

                                <!-- DIV PARA CONTENER LAS OPCIONES  DE SIG-->
                                <div class="pt-2 card">
                                    <!-- MODULO ACPM -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO ACCIONES CORRECTIVAS, PREVENTIVAS Y DE MEJORA</h6>
                                    </div>
                                    <!-- Check RECHAZAR-ACEPTAR-CERRAR ACPM SOLO CORRESPONDE AL SIG -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smUsuarios" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para rechazar, aceptar y cerrar ACPM de los lideres de proceso.">Administrar ACPM</label>
                                    </div>
                                    <!-- Check RADICAR ACPM -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smCrearAcpm" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar una acpm, solo lideres de proceso y personal autorizado">Crear ACPM</label>
                                    </div>
                                    <!-- Check EDITAR ACPM -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smEditarAcpm" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar editar la ACPM">Editar ACPM</label>
                                    </div>
                                    <!-- Check ELIMINAR ACPM -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smEliminarAcpm" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar una acpm, solo lideres de proceso y personal autorizado">Eliminar ACPM</label>
                                    </div>
                                    <!-- Check CONSULTAR ACPM -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para consultar las ACPM que se tienen en el proceso, solo para lideres de proceso ó personal autorizado.">Consultar ACPM</label>
                                    </div>
                                    <hr>
                                    <!-- Check ASIGNAR ACTIVIDADES -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smAsignarActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para asignar actividades a los colaboradores">Asignar Actividades</label>
                                    </div>
                                    <!-- Check RESPONDER ACTIVIDADES -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder actividades que tienen asignadas">Responder Actividades</label>
                                    </div>
                                    <!-- Check EDITAR ACTIVIDADES -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smEditarActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para editar actividades creadas">Editar Actividades</label>
                                    </div>
                                    <!-- Check ELIMINAR ACTIVIDADES -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smEliminarActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar actividades creadas">Eliminar Actividades</label>
                                    </div>

                                    <br>
                                    <!-- MODULO PARA GESTIONAR SADOC -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO SADOC</h6>
                                    </div>
                                    <!-- Check SUBIR DOCUMENTACIÓN A SADOC -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smArchivosSadoc" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para subir archivos a SADOC">Añadir archivos a SADOC</label>
                                    </div>
                                    <!-- Check ELIMINAR DOCUMENTACIÓN A SADOC -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smEliminarSadoc" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para eliminar archivos de SADOC">Eliminar archivos de SADOC</label>
                                    </div>
                                    <br>
                                    <!-- MODULO PARA GESTIONAR LAS SOLICITUDES DE CODIFICACIÓN -->
                                    <div class="card pt-2">
                                        <h6 class="text-center">MODULO SOLICITUDES DE CODIFICACIÓN</h6>
                                    </div>
                                    <!-- Check CREAR SOLICITUD DE CODIFICACIÓN -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smSolicitudCodificacion" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para crear solicitudes de codificación">Crear Solicitud de Codificación</label>
                                    </div>
                                    <!-- Check RESPONDER SOLICITUD DE CODIFICACIÓN -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderCodificacion" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para Responder solicitudes de codificación">Responder Solicitudes de Codificación</label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ct" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <!-- MODULO PARA DAR LOS PERMISOS QUE TIENE CADA USUARIO CON RELACIÓN A CONTABILIDAD -->
                                <div class="card-header bg-warning">
                                    Configuraciones Contabilidad y Finanzas.
                                </div>

                                <div class="pt-2 card">
                                    <!-- DIV PARA CONTENER LAS OPCIONES  DE LAS ORDENES DE COMPRA-->
                                    <h6 class="text-center">MODULO ORDENES DE COMPRA</h6>
                                    <hr>
                                    <!-- Check CREAR ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smUsuarios" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para rechazar, aceptar y cerrar ACPM de los lideres de proceso.">Crear Orden de Compra</label>
                                    </div>
                                    <!-- Check EDITAR ORDEN DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smCrearAcpm" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para radicar una acpm, solo lideres de proceso y personal autorizado">Editar Orden de Compra</label>
                                    </div>
                                    <!-- Check ELIMINAR ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smAsignarActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para asignar actividades a los colaboradores">Eliminar Orden de Compra</label>
                                    </div>
                                    <!-- Check CONSULTAR ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smAsignarActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para asignar actividades a los colaboradores">Consultar Orden de Compra</label>
                                    </div>
                                    <hr>
                                    <!-- Check RESPONDER ACTIVIDADES -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para responder actividades que tienen asignadas">Crear Proveedor</label>
                                    </div>
                                    <hr>
                                    <!-- Check TABLA PARA QUE GESTION ADMINISTRATIVA APRUEBE LAS ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para aprobar la orden de compra y pase a revision por la gerencia">Aprobación Gestión Administrativa</label>
                                    </div>
                                    <!-- Check TABLA PARA QUE GERENCIA APRUEBE LAS ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para aprobar la orden de compra y pase a proceso de pago">Aprobación Gerencia</label>
                                    </div>
                                    <!-- Check TABLA PARA QUE CONTABILIDAD APRUEBE LAS ORDENES DE COMPRA -->
                                    <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smResponderActividades" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para ejecutar el pago de las ordenes de compra">Aprobación Contabilidad</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn bg-success">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>