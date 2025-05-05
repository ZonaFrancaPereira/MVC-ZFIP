/*=============================================
CAPTURA EL ID DE LAS VACACIONES PARA EL MODAL
=============================================*/
    $('#modal-periodo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id_vacaciones_fk = button.data('id_vacaciones_fk');
    
        var modal = $(this);
        modal.find('#id_vacaciones_fk').val(id_vacaciones_fk);
    });

/*=============================================
CAPTURA EL ID DEL USUARIO PARA EL MODAL
=============================================*/
$('#modal-periodo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_usuario_fk = button.data('id_usuario_fk');

    var modal = $(this);
    modal.find('#id_usuario_fk').val(id_usuario_fk);
});

/*=============================================
CAPTURA EL ID DEL USUARIO PARA EL MODAL
=============================================*/
$('#modal-cambiar-estado').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var nombre_administrativa = button.data('nombre_administrativa');

    var modal = $(this);
    modal.find('#nombre_administrativa').val(nombre_administrativa);
});