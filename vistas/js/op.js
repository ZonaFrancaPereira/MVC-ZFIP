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
                url: 'controladores/clientes.controlador.php',
                type: 'POST',
                data: {
                    action: 'EliminarCliente',
                     idCliente: idCliente,
                      eliminar: 'si' },
                success: function (response) {
                    //console.log(gato); // Muestra la respuesta completa en la consola del navegador.
                    //alert(JSON.stringify(gato)); // Convierte el objeto JSON a texto y lo muestra en un alert.
                    // Verificar la respuesta del servidor
                    if (response.status === "ok") {
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: "success",
                            title: "¡El Cliente ha sido eliminado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function (result) {
                            if (result.value) {
                                // Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();
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
                               // Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();
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
