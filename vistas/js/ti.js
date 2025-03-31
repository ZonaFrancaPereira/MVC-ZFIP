
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


var tablaImpresora = $("#tabla-ti-impresora").DataTable({
	"ajax": {
		"url": "ajax/datatable-mantenimiento.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "ti-impresora"; // Ejemplo de parámetro, ajusta según tu lógica
			console.log("Valor de específico:", d.especifico);
		},
		"dataSrc": "data" // Nombre del objeto JSON que contiene los datos para DataTable
	},
	"deferRender": true,
	"serverSide": true,
	"retrieve": true,
	"processing": true,
	"language": {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sSearch": "Buscar:",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
		"buttons": {
			"copy": "Copiar",
			"colvis": "Visibilidad"
		}
	},
	responsive: "true",
	dom: "Bfrtilp",


	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],



	"order": [[0, 'desc']],
	autoWidth: true

});

var tablaGeneral = $("#tabla-ti-general").DataTable({
	"ajax": {
		"url": "ajax/datatable-mantenimiento.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "ti-general"; // Ejemplo de parámetro, ajusta según tu lógica
			console.log("Valor de específico:", d.especifico);
		},
		"dataSrc": "data" // Nombre del objeto JSON que contiene los datos para DataTable
	},
	"deferRender": true,
	"serverSide": true,
	"retrieve": true,
	"processing": true,
	"language": {
		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sSearch": "Buscar:",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
		"buttons": {
			"copy": "Copiar",
			"colvis": "Visibilidad"
		}
	},
	responsive: "true",
	dom: "Bfrtilp",


	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],



	"order": [[0, 'desc']],
	autoWidth: true

});