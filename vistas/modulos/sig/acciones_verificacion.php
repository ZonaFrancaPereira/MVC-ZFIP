<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Acciones en Verificacion </li>
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
                        <h3 class="card-title">ACPM </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-verificacion-sig" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre del responsable</th>
                                    <th>Origen Acpm</th>
                                    <th>Fuente</th>
                                    <th>Tipo de Reporte</th>
                                    <th>Descripcion Acpm</th>
                                    <th>Fecha Finalizacion</th>
                                    <th>Informe</th>
                                    <th>Asignar actividades</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal fade" id="modal-success">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header btn bg-info btn-block">
                                    <h4 class="modal-title">ASIGNAR ACTIVIDAD</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="form_actividades" method="POST" enctype="multipart/form-data" onsubmit="return evitarDuplicado(this)">
                                            <div class="card">
                                                <div class="card-header" hidden>
                                                    <label>Desea Asignar actividades a la siguiente ACPM:</label>
                                                    <input type="text" class="form-control" id="id_acpm_fk" readonly>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                                            <label for="">Fecha vencimiento de la Actividad</label>
                                                            <input type="date" name="fecha_actividad" class="form-control" id="fecha_actividad" required>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                                                            <label for="">Descripción de la Actividad</label>
                                                            <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad"></textarea>
                                                        </div>
                                                        <div class="col-2 col-xs-12 col-sm-12" hidden>
                                                            <label for="">Tipo actividad</label>
                                                            <input type="textarea" class="form-control" value="Actividad" name="tipo_actividad" id="tipo_actividad" readonly>
                                                        </div>
                                                        <div class="col-2 col-xs-12 col-sm-12" hidden>
                                                            <label for="">Estado de la Actividad</label>
                                                            <input type="text" class="form-control" value="incompleta" name="estado_actividad" id="estado_actividad" readonly>
                                                        </div>
                                                        <div class="col-2 col-xs-12 col-sm-12">
                                                            <label for="">Nombre del Responsable:</label>
                                                            <input list="usuarios" id="id_usuario_fk_6" name="id_usuario_fk_6" class="form-control" placeholder="Nombre del responsable" required>
                                                            <datalist id="usuarios">
                                                                    <?php
                                                                if ($usuario["id"] <> 0) {
                                                                    echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                                                }
                                                                $item = null;
                                                                $valor = null;
                                                                $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                                                foreach ($usuario as $key => $value) {
                                                                    echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                        <div class="col-2 col-xs-12 col-sm-12" hidden>
                                                            <label for="">ID acpm</label>
                                                            <input type="text" class="form-control" value="" name="id_acpm_fk" id="id_acpm_fk">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                                        <button type="submit" class="btn bg-info btn-block ">Asignar Actividad</button>
                                                    </div>
                                                </div>
                                                <?php
                                                $CrearActividad = new ControladorAcpm();
                                                $CrearActividad->ctrCrearActividad();
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
</section><script>
function evitarDuplicado(form) {
    const boton = form.querySelector('button[type="submit"], input[type="submit"]');
    if (boton) {
        boton.disabled = true;
        boton.innerText = "Guardando...";
    }
    sessionStorage.setItem("formEnviado", "true");
    return true; // permite el envío
}
</script>
<script>
// Limpia el historial (evita reenvío al dar F5)
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Si el formulario fue enviado, esperemos a que PHP muestre el Swal
// y luego, cuando se cierre, recargamos con GET
if (sessionStorage.getItem("formEnviado")) {
    // Borramos la marca solo después de un pequeño tiempo
    setTimeout(() => {
        sessionStorage.removeItem("formEnviado");
        // Recarga limpia (sin POST) después del SweetAlert
        window.addEventListener('click', () => {
            window.location.replace(window.location.href);
        }, { once: true });
    }, 500);
}
</script>

