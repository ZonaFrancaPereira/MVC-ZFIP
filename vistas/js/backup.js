    /*=============================================
	            TABLA PARA ASIGNAR LA RUTA
	=============================================*/
var tablaBackup = $("#tabla-backup").DataTable({
	"ajax": {
		"url": "ajax/datatable-backup.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "backup"; // Ejemplo de parámetro, ajusta según tu lógica
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
	            TABLA PARA REALIZAR LA VERIFICACION
	=============================================*/
var tablaVerificarBackup = $("#tabla-verificar-backup").DataTable({
	"ajax": {
		"url": "ajax/datatable-backup.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "backup-Verificar"; // Ejemplo de parámetro, ajusta según tu lógica
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
	   VISUALIZACION DE LAS VERIFICACIONES DE BACKUP POR PARTE DE LOS USUARIOS
	=============================================*/
	var tablaPanelBackup = $("#tabla-panel-backup").DataTable({
		"ajax": {
			"url": "ajax/datatable-backup.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
			"type": "POST", // Método de solicitud POST
			"data": function (d) {
	
				// Puedes enviar parámetros adicionales si es necesario
				d.especifico = "backup-Panel"; // Ejemplo de parámetro, ajusta según tu lógica
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
	            MODAL ASIGNAR RUTA
	=============================================*/
	$(document).on('show.bs.modal', '#modal-ruta', function(event) {
		var button = $(event.relatedTarget); // Botón que activó el modal
		var id_usuario_backup_fk = button.data('id_usuario_backup_fk'); // Extrae el valor de data-id_usuario_backup_fk
		var modal = $(this);
		
		console.log('ID del usuario:', id_usuario_backup_fk);
	
		// Asigna el valor al input dentro del modal
		modal.find('.modal-body #id_usuario_backup_fk').val(id_usuario_backup_fk);
	});
	
    /*=============================================
	            VERIFICAR BACKUP
	=============================================*/
	$(document).on('show.bs.modal', '#modal-verificar_backup', function(event) {
		var button = $(event.relatedTarget); // Botón que activó el modal
		var id_usuario_copia = button.data('id_usuario_copia'); // Extrae el valor de data-id_usuario_copia
		var modal = $(this);
		
		console.log('ID del usuario:', id_usuario_copia);
	
		// Asigna el valor al input dentro del modal
		modal.find('.modal-body #id_usuario_copia').val(id_usuario_copia);
	});

	$(document).on('show.bs.modal', '#modal-verificar_backup', function(event) {
		var button = $(event.relatedTarget); // Botón que activó el modal
		var carpeta_copia = button.data('carpeta_copia'); // Extrae el valor de data-carpeta_copia
		var modal = $(this);
		
		console.log('ID del usuario:', carpeta_copia);
	
		// Asigna el valor al input dentro del modal
		modal.find('.modal-body #carpeta_copia').val(carpeta_copia);
	});
	