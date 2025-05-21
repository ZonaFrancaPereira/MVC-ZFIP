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
    var editar_nombre = button.data('editar_nombre');

    var modal = $(this);
    modal.find('#editar_nombre').val(editar_nombre);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#modal-cambiar-estado').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_cedula = button.data('editar_cedula');

    var modal = $(this);
    modal.find('#editar_cedula').val(editar_cedula);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#modal-cambiar-estado').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_ingreso = button.data('editar_ingreso');

    var modal = $(this);
    modal.find('#editar_ingreso').val(editar_ingreso);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#modal-cambiar-estado').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_editar = button.data('id_editar');

    var modal = $(this);
    modal.find('#id_editar').val(id_editar);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#editVacationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_disfrutadas = button.data('editar_disfrutadas');

    var modal = $(this);
    modal.find('#editar_disfrutadas').val(editar_disfrutadas);
});


/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#editVacationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_pendientes_periodo = button.data('editar_pendientes_periodo');

    var modal = $(this);
    modal.find('#editar_pendientes_periodo').val(editar_pendientes_periodo);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#editVacationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_disfrutadas = button.data('editar_disfrutadas');

    var modal = $(this);
    modal.find('#editar_disfrutadas').val(editar_disfrutadas);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#editVacationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_observaciones_vacaciones = button.data('editar_observaciones_vacaciones');

    var modal = $(this);
    modal.find('#editar_observaciones_vacaciones').val(editar_observaciones_vacaciones);
});

/*=============================================
CAPTURA LA CEDULA DEL USUARIO PARA EL MODAL
=============================================*/
$('#editVacationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var editar_id_vacacion = button.data('editar_id_vacacion');

    var modal = $(this);
    modal.find('#editar_id_vacacion').val(editar_id_vacacion);
});

/*=============================================
CAPTURA EL ID PARA SOLICITAR VACACIONES
=============================================*/
$('#vacacionesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_detalle_vacaciones_fk = button.data('id_detalle_vacaciones_fk');

    var modal = $(this);
    modal.find('#id_detalle_vacaciones_fk').val(id_detalle_vacaciones_fk);
});

$('#vacacionesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_usuario_detalle_fk = button.data('id_usuario_detalle_fk');

    var modal = $(this);
    modal.find('#id_usuario_detalle_fk').val(id_usuario_detalle_fk);
});

$('#vacacionesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_vacaciones_detalle_fk = button.data('id_vacaciones_detalle_fk');

    var modal = $(this);
    modal.find('#id_vacaciones_detalle_fk').val(id_vacaciones_detalle_fk);
});

/*=============================================
CAPTURA EL ID PARA APROBAR LAS VACACIONES
=============================================*/
$('#modal-Aprobar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_solicitud = button.data('id_solicitud');

    var modal = $(this);
    modal.find('#id_solicitud').val(id_solicitud);
});

/*=============================================
CAPTURA EL ID PARA RECHAZAR LAS VACACIONES
=============================================*/
$('#modal-Rechazar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id_solicitud_rechazo = button.data('id_solicitud_rechazo');

    var modal = $(this);
    modal.find('#id_solicitud_rechazo').val(id_solicitud_rechazo);
});