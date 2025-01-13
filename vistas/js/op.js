$(".table").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
  
	Swal.fire({
		title: '¿Está seguro de borrar el Cliente?',
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: '#27ae60',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, borrar Cliente!'
	}).then(function(result){
	  if(result.value){

		$.ajax({
		  url: 'ti',
		  type: 'POST',
		  data: { idCliente: idCliente, eliminar: 'si' },
		  success: function(response) {
			Swal.fire(
			  '¡Eliminado!',
			  'El perfil ha sido eliminado.',
			  'success'
			).then(function() {
	
			  $("#ConsultarPerfil").addClass("active");
			  tablaPerfiles.ajax.reload();
			 
			});
		  },
		  error: function() {
			Swal.fire(
			  '¡Error!',
			  'Hubo un problema al eliminar el perfil.',
			  'error'
			);
		  }
		});
	  }
	});
  
  });
