<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Realizar Solicitud</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Realizar Solicitud</h3>
                    </div>
                    <div class="card-body">
                        <!-- FORMULARIO DE SOLICITUD DE CODIFICACION DE DOCUMENTOS -->
                        <div id="codificar_solicitud_sig" class="tab-pane">
                            <div class="tab-pane  show active" id="panelc">
                                <div id="" class="tab-pane">
                                    <div class="card-body">
                                        <div class="card card-info">
                                            <div class="card-body">

                                                <form id="codificar" method="POST" enctype="multipart/form-data" >
                                                    <div class="container">
                                                        <h2 class="text-center mb-4">Formulario de Solicitud de Codificación</h2>

                                                        <div class="row mb-3">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Vigencia</label>
                                                                    <select class="form-control select2" id="vigencia" name="vigencia">
                                                                        <option value="Nuevo">Nuevo</option>
                                                                        <option value="Antiguo">Antiguo</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="fecha_solicitud_cod">Fecha</label>
                                                                    <input type="date" name="fecha_solicitud_cod" class="form-control" id="fecha_solicitud_cod" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="usuario_solicitud_cod">Solicitado por</label>
                                                                    <input type="text" class="form-control" id="usuario_solicitud_cod" value="<?php echo $_SESSION['nombre'] ?>" name="usuario_solicitud_cod" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="cargo_solicitud_cod">Cargo</label>
                                                                    <input type="text" class="form-control" id="cargo_solicitud_cod" value="<?php echo $_SESSION['id_cargo_fk'] ?>" name="cargo_solicitud_cod" placeholder="Proceso" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="nombre_documento">Nombre del Documento</label>
                                                                    <input type="text" class="form-control" id="nombre_documento" name="nombre_documento" placeholder="Nombre del Documento" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="codigo">Código</label>
                                                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="descripcion_cambio">Descripción del Cambio</label>
                                                            <textarea class="form-control" id="descripcion_cambio" name="descripcion_cambio" rows="3" placeholder="Descripción" required></textarea>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="link_formato_codificacion">Link Documento Modificado</label>
                                                            <textarea class="textarea" id="link_formato_codificacion" name="link_formato_codificacion" style="display: none;" required></textarea>
                                                            <div class="quill-content"></div>
                                                        </div>

                                                        <div class="bg-info text-white text-center p-3 mb-3">
                                                            <h5>POLÍTICA DE ELABORACIÓN, REVISIÓN Y APROBACIÓN</h5>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-sm-4">
                                                                <h6 class="text-center bg-info text-white p-2">ELABORA</h6>
                                                                <div class="form-group">
                                                                    <label for="elabora_nombre">Nombre</label>
                                                                    <input type="text" class="form-control" id="elabora_nombre" name="elabora_nombre" placeholder="Nombre" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="elabora_correo">Cargo</label>
                                                                    <input type="text" class="form-control" id="elabora_correo" name="elabora_correo" placeholder="Cargo" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <h6 class="text-center bg-info text-white p-2">REVISA</h6>
                                                                <div class="form-group">
                                                                    <label for="revisa_nombre">Nombre</label>
                                                                    <input type="text" class="form-control" id="revisa_nombre" name="revisa_nombre" placeholder="Nombre" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="revisa_correo">Cargo</label>
                                                                    <input type="text" class="form-control" id="revisa_correo" name="revisa_correo" placeholder="Cargo" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <h6 class="text-center bg-info text-white p-2">APRUEBA</h6>
                                                                <div class="form-group">
                                                                    <label for="aprueba_nombre">Nombre</label>
                                                                    <input type="text" class="form-control" id="aprueba_nombre" name="aprueba_nombre" placeholder="Nombre" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="aprueba_correo">Cargo</label>
                                                                    <input type="text" class="form-control" id="aprueba_correo" name="aprueba_correo" placeholder="Cargo" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="bg-info text-white text-center p-3 mb-3">
                                                            <h5>DOCUMENTOS RELACIONADOS O ANEXOS</h5>
                                                        </div>

                                                        <h8>Enliste a continuación los documentos relacionados o anexos del documento en modificación y determine si el cambio los afecta. En caso positivo, proceda con la actualización adicional aplicable al documento identificado, siguiendo los lineamientos del procedimiento de control de documentos. Anexe tantas celdas como sea necesario y evalúe conscientemente cada documento que cita a continuación</h8>

                                                        <div class="table-responsive mb-3">
                                                            <table class="table" id="tabla">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Código</th>
                                                                        <th>Nombre</th>
                                                                        <th>¿Se afecta? (SI / NO)</th>
                                                                        <th>X</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="fila-fija">
                                                                        <td class="col-md-2">
                                                                            <input type="text" id="codigo_doc_afectado" name="codigo_doc_afectado" class="codigo_doc_afectado form-control" placeholder="Código" step="any">
                                                                        </td>
                                                                        <td class="col-md-2">
                                                                            <input type="text" id="nombre_doc_afectado" name="nombre_doc_afectado" class="nombre_doc_afectado form-control" placeholder="Nombre" step="any">
                                                                        </td>
                                                                        <td class="col-md-2">
                                                                            <select class="form-control select2" id="afecta" name="afecta">
                                                                                <option value=""></option>
                                                                                <option value="Si">Si</option>
                                                                                <option value="No">No</option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="eliminar col-md-1">
                                                                            <input type="button" class="btn btn-danger" value="X" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for=""><B>Añade más campos</B></label>
                                                                    <button id="adicional" name="adicional" type="button" class="adicional btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="bg-info text-white text-center p-3 mb-3">
                                                            <h5>DIFUSIONES</h5>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-sm-5">
                                                                <h6 class="text-center bg-info text-white p-2">INTERNA</h6>

                                                                <div class="form-group">
                                                                    <label for="">Seleccionar Colaboradores</label>
                                                                    <br>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="checkbox" id="checkAll" name="todos_colaboradores" value="Si" onclick="handleCheckboxChange()">
                                                                        <label for="checkAll">Todos los Colaboradores</label>
                                                                    </div>
                                                                    <br>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="checkbox" id="checkLeaders" name="solo_lider" value="Si" onclick="handleCheckboxChange()">
                                                                        <label for="checkLeaders">Sólo Líderes de Proceso</label>
                                                                    </div>
                                                                    <br>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="checkbox" id="checkMembers" name="miembros_proceso" value="Si" onclick="handleCheckboxChange()">
                                                                        <label for="checkMembers">Colaborador(s) Específico </label>
                                                                    </div>
                                                                    <br>
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="checkbox" id="checkSpecific" name="colaborador_expecifico" value="Si" onclick="handleCheckboxChange()">
                                                                        <label for="checkSpecific"> Sólo Miembros de un Proceso</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Campo oculto para especificar miembros -->
                                                                <div id="memberInput" class="form-group" style="display: none;">
                                                                    <label for="nombre_proceso_cod">Especificar Miembros:</label>
                                                                    <input type="text" id="nombre_proceso_cod" name="nombre_proceso_cod" class="form-control" placeholder="Ingrese el nombre del miembro">
                                                                </div>

                                                                <table class="table" id="tabla3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nombre</th>
                                                                            <th>Correo</th>
                                                                            <th>X</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="fila-fija3">
                                                                            <td class="col-md-2">
                                                                                <input type="text" name="nombre_interna" class="nombre_interna form-control" placeholder="Nombre" step="any">
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <input type="text" name="correo_interna" class="correo_interna form-control" placeholder="Correo" step="any">
                                                                            </td>
                                                                            <td class="eliminar col-md-1">
                                                                                <input type="button" class="btn btn-danger" value="X" />
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for=""><B>Añade más campos</B></label>
                                                                        <button id="adicional3" name="adicional3" type="button" class="adicional3 btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h6 class="text-center bg-info text-white p-2">Externa</h6>
                                                                <table class="table" id="tabla2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nombre</th>
                                                                            <th>Correo</th>
                                                                            <th>X</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="fila-fija2">
                                                                            <td class="col-md-2">
                                                                                <input type="text" name="nombre_externa" class="nombre_externa form-control" placeholder="Nombre" step="any">
                                                                            </td>
                                                                            <td class="col-md-2">
                                                                                <input type="text" name="correo_externa" class="correo_externa form-control" placeholder="Correo" step="any">
                                                                            </td>
                                                                            <td class="eliminar col-md-1">
                                                                                <input type="button" class="btn btn-danger" value="X" />
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for=""><B>Añade más campos</B></label>
                                                                        <button id="adicional2" name="adicional2" type="button" class="adicional2 btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        ¿Se requiere envío de copia NO controlada del Documento, a las partes externas?
                                                                        <input type="radio" id="radioPrimary9" name="enviar_copia" value="Si">
                                                                        <label for="radioPrimary9">Sí, enviar copia</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-center mb-3">
                                                            Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, usted declara que conoce nuestra política de tratamiento de datos personales disponible en: www.politicadeprivacidad.co/politica/zfipusuariooperador, también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS con NIT 900311215 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-info btn-block" id="enviar_solicitud_codificacion" name="enviar_solicitud_codificacion">Enviar Solicitud</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                              
                                                        $Crear_Codificacion = new ControladorCodificar();
                                                        $Crear_Codificacion->ctrIngresarCodificacion();
                                                    
                                                    
                                                    ?>
                                                </form>

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
    </div>
</section>

 <script>
function handleCheckboxChange() {
    const checkSpecific = document.getElementById('checkSpecific');
    const memberInput = document.getElementById('memberInput');

    if (checkSpecific.checked) {
        memberInput.style.display = 'block';
    } else {
        memberInput.style.display = 'none';
    }
}
</script>