
var tablaJuridico = $("#tabla-soporte-juridico").DataTable({
	"ajax": {
		"url": "ajax/datatable-juridico.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "solicitudjuridico"; // Ejemplo de parámetro, ajusta según tu lógica
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


var tablaJuridicoFinalizada = $("#tabla-finalizada-juridico").DataTable({
	"ajax": {
		"url": "ajax/datatable-juridico.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "solicitudjuridicofinalizada"; // Ejemplo de parámetro, ajusta según tu lógica
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

var tablaJuridicoRealizada = $("#tabla-realizada-juridico").DataTable({
	"ajax": {
		"url": "ajax/datatable-juridico.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "solicitudjuridicorealizada"; // Ejemplo de parámetro, ajusta según tu lógica
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

var tablaJuridicoAceptar = $("#tabla-aceptar-juridico").DataTable({
	"ajax": {
		"url": "ajax/datatable-juridico.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "solicitudjuridicoaceptar"; // Ejemplo de parámetro, ajusta según tu lógica
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
/*=============================================
DAR RESPUESTA
=============================================*/
$('#modal-juridico').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var id_soporte_juridico = button.data('id_soporte_juridico'); // Extract info from data-* attributes

	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this);

	modal.find('.modal-body #id_soporte_juridico').val(id_soporte_juridico);
});

/*=============================================
CAMBIAR ESTADO
=============================================*/
$('#estadoSoporteModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var aceptar_solicitud = button.data('aceptar_solicitud'); // Extract info from data-* attributes

	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this);

	modal.find('.modal-body #aceptar_solicitud').val(aceptar_solicitud);
});