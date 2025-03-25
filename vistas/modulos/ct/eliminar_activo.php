<?php

$usuarioSeleccionado = isset($_GET["usuario"]) && $_GET["usuario"] !== "" ? $_GET["usuario"] : null;
$item = null;
$valor = null;
// Obtener usuarios
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
//print_r($usuarios); // <-- TEMPORAL: Verifica si trae usuarios

// Obtener activos solo si se seleccionó un usuario
$activos = ($usuarioSeleccionado) ? ControladorActivos::obtenerActivosConUsuariosBaja($usuarioSeleccionado) : [];
//print_r($activos); // <-- TEMPORAL: Verifica si trae activos
?>





<div class="container mt-4">
    <h2 class="mb-3 text-center">Dar de Baja Activos</h2>

    <!-- Formulario para seleccionar usuario -->
    <form method="GET">
        <label for="usuario">Seleccionar Usuario:</label>
        <select name="usuario" id="usuario" class="form-control">
            <option value="">-- Seleccione un usuario --</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= $usuario["id"] ?>" <?= ($usuario["id"] == $usuarioSeleccionado) ? "selected" : "" ?>>
                    <?= "{$usuario["nombre"]} {$usuario["apellidos_usuario"]}" ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
    </form>

    <!-- Formulario para dar de baja activos -->
    <form method="POST" id="formDarBaja">
        <div class="row mt-3">
            <div class="col-md-12 mb-3">
                <label for="activos_baja" class="form-label">Selecciona los activos:</label>
                <select id="activos_baja" name="id_activo[]" multiple class="select2 form-control">
                    <?php foreach ($activos as $activo): ?>
                        <option value="<?= $activo["id_activo"] ?>" data-usuario="<?= $activo["id_usuario_fk"] ?>">
                            <?= "{$activo["id_activo"]} - {$activo["nombre_articulo"]} - {$activo["nombre_usuario"]} {$activo["apellidos_usuario"]}" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Observaciones -->
            <div class="col-md-12 mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <textarea name="observaciones" class="form-control" required></textarea>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" name="dar_baja" class="btn btn-danger">Dar de Baja</button>
            </div>
        </div>
    </form>
</div>

<!-- Script -->
<script>
$(document).ready(function() {
    // Inicializar Select2
    $('.select2').select2({
        placeholder: "Selecciona activos",
        allowClear: true,
        width: '100%'
    });

    // Manejo del formulario
    $("#formDarBaja").submit(function(event) {
        event.preventDefault(); // Evita el envío inmediato

        let activosSeleccionados = $('#activos_baja').val();
        console.log("Activos seleccionados:", activosSeleccionados);

        if (!activosSeleccionados || activosSeleccionados.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Atención",
                text: "Debes seleccionar al menos un activo.",
                confirmButtonColor: "#007bff"
            });
            return;
        }

        // Validar que todos los activos pertenezcan al mismo usuario
        let usuarios = new Set();
        $("#activos_baja option:selected").each(function() {
            let usuario = $(this).attr("data-usuario");
            usuario = usuario ? usuario.toString().trim() : "";
            usuarios.add(usuario);
        });

        console.log("Usuarios detectados:", Array.from(usuarios));

        if (usuarios.size > 1) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Todos los activos seleccionados deben pertenecer al mismo usuario.",
                confirmButtonColor: "#dc3545"
            });
            return;
        }

        // Confirmación con SweetAlert
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción dará de baja los activos seleccionados.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sí, dar de baja",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $("#formDarBaja")[0].submit();
            }
        });
    });
});
</script>
