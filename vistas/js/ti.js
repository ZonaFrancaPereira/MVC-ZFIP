
/*=============================================
ASIGNAR URGENCIA
=============================================*/
$('#modal-urgencia').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id_soporte = button.data('id_soporte'); // Extract info from data-* attributes

	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this);

	modal.find('.modal-body #id_soporte').val(id_soporte);
});

/*=============================================
DAR RESPUESTA
=============================================*/
$('#modal-solicitud').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id_soporte1 = button.data('id_soporte1'); // Extract info from data-* attributes

	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this);

	modal.find('.modal-body #id_soporte1').val(id_soporte1);
});

$('#firmaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que abrió el modal
    var idMantenimiento = button.data('id'); // Extraemos el id del botón

    var modal = $(this);
    modal.find('.modal-body #id_mantenimiento').val(idMantenimiento); // Rellenamos el campo oculto con el id
});

$('#firmaModalGeneral').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que abrió el modal
    var id_general = button.data('id'); // Extraemos el id del botón

    var modal = $(this);
    modal.find('.modal-body #id_general').val(id_general); // Rellenamos el campo oculto con el id
});


$('#firmaModalImpresora').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que abrió el modal
    var id_impresora = button.data('id'); // Extraemos el id del botón

    var modal = $(this);
    modal.find('.modal-body #id_impresora').val(id_impresora); // Rellenamos el campo oculto con el id
});
