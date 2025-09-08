$(document).ready(iniciar_ct);

function iniciar_ct() {
	$(".ReporteInventario").on("click", informe_inventario);
	//$(".aprobarAcpm").on("click", aprobarAcpm);

}
//function aprobarAcpm() {
	//alert("dgdffg");
//}
function informe_inventario() {
	var id_inventario = $(this).data('id_inventario');
	//alert('ID de Inventario: ' + id_inventario);
	window.open("extensiones/tcpdf/pdf/inventariopdf.php?cod=" + id_inventario, "_blank");

}
//TABLAS Y DEMAS FUNCIONES COMO MODALES
var tablaInventario = $("#tabla-inventario").DataTable({
	"ajax": "ajax/datatable-inventario.ajax.php",
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



	"order": [[0, 'asc']],
	autoWidth: true

});

// ============================
// TABLA DE ACTIVOS VERIFICADOS
// ============================
var tablaVerificados = $("#tabla-Averificados").DataTable({
	"ajax": {
		"url": "ajax/datatable-verificarActivos.ajax.php", // Ruta a tu archivo PHP
		"type": "POST",
		"data": function (d) {
			// Enviamos el parámetro para saber que se deben traer los verificados
			d.especifico = "verificados";

			// Puedes enviar otros parámetros como id_inventario si lo necesitas
			d.id_inventario = $("#selectInventario").val() || 123;

			console.log("AJAX Verificados - envío:", d);
		},
		"dataSrc": function (json) {
			console.log("Respuesta verificados:", json);
			return json.data || [];
		}
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
	responsive: true,
	dom: "Bfrtilp",
	buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
	"order": [[0, 'desc']],
	autoWidth: true
});


// ======================================
// TABLA DE ACTIVOS SIN VERIFICAR
// ======================================
var tablasinVerificados = $("#tabla-sinverificar").DataTable({
	"ajax": {
		"url": "ajax/datatable-verificarActivos.ajax.php",
		"type": "POST",
		"data": function (d) {
			// Este parámetro es clave para que PHP ejecute el bloque correcto
			d.especifico = "noverificados";

			// Puedes usar un select para enviar dinámicamente el inventario
			d.id_inventario = $("#selectInventario").val() || 123;

			console.log("AJAX No Verificados - envío:", d);
		},
		"dataSrc": function (json) {
			console.log("Respuesta no verificados:", json);
			return json.data || [];
		}
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
	responsive: true,
	dom: "Bfrtilp",
	buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
	"order": [[0, 'desc']],
	autoWidth: true
});


// ============================
// REFRESCAR TABLAS
// ============================
// Si necesitas actualizar las tablas automáticamente después de alguna acción
function recargarTablas() {
	tablaVerificados.ajax.reload(null, false);
	tablasinVerificados.ajax.reload(null, false);
}



//MODAL PARA CERRAR EL INVENTARIO
$('#modalCerrarInventario').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget);
	var id_inventario = button.data('id_inventario');

	var modal = $(this);
	modal.find('.modal-title').text('Cierrre de Inventario # : ' + id_inventario);
	modal.find('.modal-body #id_inventario').val(id_inventario);
});

// Capturar el div cuando se hace clic en él
document.querySelectorAll('.product-info').forEach((div) => {
	div.addEventListener('click', function () {
		// Capturar el li entero
		html2canvas(this.parentNode, {
			allowTaint: true,
			useCORS: true,
			backgroundColor: null
		}).then(canvas => {
			// Convertir a Data URL y descargar
			const imgData = canvas.toDataURL('image/png');
			const link = document.createElement('a');
			link.href = imgData;
			link.download = 'captured-product.png';
			link.click();
		}).catch(error => {
			console.error('Error capturando el contenido:', error);
		});
	});
});