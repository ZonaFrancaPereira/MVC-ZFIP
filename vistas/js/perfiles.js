/*=============================================
EDITAR PERFIL
=============================================*/
$(".table").on("click", ".btnEditarPerfil", function(){

	var idPerfil= $(this).attr("idPerfil");



	var datos = new FormData();
	datos.append("idPerfil", idPerfil);

	console.log(idPerfil);

	$.ajax({

		url:"ajax/perfiles.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#idPerfil").val(respuesta["perfil"]);



		}

	});

})



$(".table").on("click", ".btnEliminarPerfil", function(){

	var idPerfil = $(this).attr("idPerfil");
  
	Swal.fire({
	  title: '¿Está seguro de borrar el Perfil?',
	  text: "¡Si no lo está puede cancelar la acción!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: 'Cancelar',
	  confirmButtonText: 'Sí, borrar perfil!'
	}).then(function(result){
	  if(result.value){
		$.ajax({
		  url: 'index.php',
		  type: 'POST',
		  data: { idPerfil: idPerfil, eliminar: 'si' },
		  success: function(response) {
			Swal.fire(
			  'Eliminado!',
			  'El perfil ha sido eliminado.',
			  'success'
			).then(function() {
			  // Puedes actualizar la tabla o redirigir
			  location.reload(); // Recargar la página para reflejar los cambios
			});
		  },
		  error: function() {
			Swal.fire(
			  'Error!',
			  'Hubo un problema al eliminar el perfil.',
			  'error'
			);
		  }
		});
	  }
	});
  
  });
