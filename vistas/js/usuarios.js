var tablaUsuarios = $(".tabla-usuarios").DataTable({

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

/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);
                        $(".previsualizarEditar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tabla-usuarios").on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");

	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			console.log(respuesta);

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != ""){

				$(".previsualizarEditar").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}
                        
                        if(respuesta[10] != ""){
                            
                            $(".previsualizarEditar").attr("src","data:image/png;base64, "+respuesta[10]);
                            
                        }

		}

	});

})

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tabla-usuarios").on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El usuario ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "usuarios";

			        }


				});

	      	}

      }

  	})

  	if(estadoUsuario == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}

})

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tabla-usuarios").on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var correo_usuario = $(this).attr("correo_usuario");
	var fila = $(this).closest("tr");  // Selecciona la fila que contiene el botón
  
	Swal.fire({
	  title: '¿Está seguro de borrar el usuario?',
	  text: "¡Si no lo está puede cancelar la acción!",
	  icon: 'warning',  // Cambiado de 'type' a 'icon'
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: 'Cancelar',
	  confirmButtonText: 'Sí, borrar usuario!'
	}).then(function(result){
  
	  if(result.isConfirmed){
		$.ajax({
		  url: 'ti',  // Cambiar por la URL correcta para eliminar el usuario
		  type: 'POST',
		  data: { idUsuario: idUsuario, fotoUsuario: fotoUsuario, correo_usuario: correo_usuario },
		  success: function(response) {
			Swal.fire(
			  'Eliminado!',
			  'El usuario ha sido eliminado.',
			  'success'
			).then(function() {
			  // Eliminar la fila de la tabla
			  tablaUsuarios.row(fila).remove().draw();
			});
		  },
		  error: function() {
			Swal.fire(
			  'Error!',
			  'Hubo un problema al eliminar el usuario.',
			  'error'
			);
		  }
		});
	  }
  
	});
  
  });
  

