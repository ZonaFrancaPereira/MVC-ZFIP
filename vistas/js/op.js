$(".table").on("click", ".btnEliminarCliente", function () {
    // Capturar el ID del cliente
    var idCliente = $(this).attr("idCliente");

    // Mostrar alerta de confirmación
    Swal.fire({
        title: '¿Está seguro de borrar el Cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: '#27ae60',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar Cliente!'
    }).then(function (result) {
        if (result.value) {
            // Enviar la solicitud AJAX
            $.ajax({
                url: 'operaciones',
                type: 'POST',
                data: { idCliente: idCliente, eliminar: 'si' },
                success: function (response) {
                    // Verificar la respuesta del servidor
                    if (response.status === "success") {
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: "success",
                            title: "¡El Cliente ha sido eliminado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function (result) {
                            if (result.value) {
                                window.location = "usuarios"; // Redirigir a la página de usuarios
                            }
                        });
                    } else {
                        // Mostrar mensaje de error personalizado del servidor
                        Swal.fire({
                            icon: "error",
                            title: "Error",
							text: "¡No es posible eliminar al cliente, ya que existen registros asociados a su nombre!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function (result) {
                            if (result.value) {
                                window.location = "operaciones"; // Redirigir a la página de operaciones
                            }
                        });
                    }
                },
                error: function () {
                    // Mostrar mensaje de error en caso de falla del servidor
                    Swal.fire(
                        '¡Error!',
                        'Ocurrió un problema con el servidor. Intente de nuevo más tarde.',
                        'error'
                    );
                }
            });
        }
    });
});
