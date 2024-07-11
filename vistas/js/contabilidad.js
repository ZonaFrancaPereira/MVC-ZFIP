var tablaInventario = $("#tabla-inventario").DataTable({
	"ajax": "ajax/datatable-inventario.ajax.php",
    "deferRender": true,
     "serverSide" : true,
	"retrieve": true,
	"processing": true,
	"language":{
	  "sProcessing":     "Procesando...",
	  "sLengthMenu":     "Mostrar _MENU_ registros",
	  "sZeroRecords":    "No se encontraron resultados",
	  "sEmptyTable":     "Ningún dato disponible en esta tabla",
	  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	  "sSearch":         "Buscar:",
	  "sInfoThousands":  ",",
	  "sLoadingRecords": "Cargando...",
	  "oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	  },
	  "oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	  },
	  "buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	  }
	},
	responsive:"true",
	dom:"Bfrtilp",
	
	
	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
	
	
	
	"order":[[0,'desc']],
	autoWidth: true
	
});

var tablaVerificados = $("#tabla-verificados").DataTable({
		"ajax": {
			"url": "ajax/datatable-verificarActivos.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
			"type": "POST", // Método de solicitud POST
			"data": function (d) {
	
				// Puedes enviar parámetros adicionales si es necesario
				d.especifico = "verificados"; // Ejemplo de parámetro, ajusta según tu lógica
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

var tablaVerificados = $("#tabla-sinverificar").DataTable({
	"ajax": {
		"url": "ajax/datatable-verificarActivos.ajax.php", // Ruta a tu archivo PHP que devuelve los datos JSON
		"type": "POST", // Método de solicitud POST
		"data": function (d) {

			// Puedes enviar parámetros adicionales si es necesario
			d.especifico = "noverificados"; // Ejemplo de parámetro, ajusta según tu lógica
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

