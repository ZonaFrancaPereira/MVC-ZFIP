
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
	