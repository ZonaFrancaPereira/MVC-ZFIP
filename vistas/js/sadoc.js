$(document).ready(iniciar);

function iniciar() {
    $(".volver").hide();
	$(".sacar").show();
	$("#include_SIG").hide();
	$("#include_TI").hide();
	$("#include_CT").hide();
	$("#include_TEC").hide();
	$("#include_GH").hide();
	$("#include_GD").hide();
	$("#include_OP").hide();
	$("#include_JR").hide();
	$("#include_PH").hide();
	$("#include_GR").hide();
	$("#include_SST").hide();
	$("#include_PLE").hide();

	//esconder los botones de el panel (volver y panel principal)
	$("#panel").hide();
	$("#panel_TI").hide();
	$("#panel_CT").hide();
	$("#panel_TEC").hide();
	$("#panel_GH").hide();
	$("#panel_GD").hide();
	$("#panel_OP").hide();
	$("#panel_PH").hide();
	$("#panel_JR").hide();
	$("#panel_GR").hide();
	$("#panel_SST").hide();
	$("#panel_PLE").hide();

	
    $("#wrapper").toggleClass("toggled");
    $(".sacar").click(mostrar);
    $(".volver").click(mostrar2);

    listar_cargos();
    $("#registrar_Usuario").click(insert_user);
}

function mostrar() {
    $("#wrapper").toggleClass("toggled");
    $(".volver").show();
    $(".sacar").hide();
}

function mostrar2() {
    $("#wrapper").toggleClass("toggled");
    $(".volver").hide();
    $(".sacar").show();
}

function activar_menus(cargo, siglas, idProceso) {
    console.log('Activar Menús:', cargo, siglas, idProceso); // Verifica los parámetros

    if (cargo == siglas) {
        console.log(`Ocultando elementos con la clase ${idProceso}`); // Verifica la clase que se oculta
        $(`.${idProceso}`).hide();
    }

    (cargo, siglas, idProceso);
}

function listar_Descargas(cargo, siglas, idProceso) {
    console.log('Listar Descargas:', cargo, siglas, idProceso); // Verifica los parámetros

    var ruta = `files/${siglas}/`;
    var json = {
        'ruta': ruta,
        'id_proceso_fk': idProceso
    };

    $.ajax({
        type: 'POST',
        data: json,
        url: 'php/lista_descarga_sadoc.php',
        success: function(data) {
            console.log('Datos recibidos de lista_descarga_sadoc.php:', data); // Verifica los datos recibidos
            $(`#descargas_${siglas}`).html(data);
            $(".eliminar_archivo").click(eliminar_registro);
            if (cargo != "SIG") {
                $(".eliminar_archivo").hide();
            }
        }
    });

    var consulta = `../${ruta}`;
    var json = {
        'consulta': consulta,
        'ruta': ruta,
        'carpeta': `_${siglas}`,
        'id_proceso_fk': idProceso
    };

    $.ajax({
        type: "POST",
      data: json,
        url: 'php/cargar_folders.php',
        success: function(data) {
            console.log('Datos recibidos de cargar_folders.php:', data); // Verifica los datos recibidos
            $(`#folder_${siglas}`).html(data);
            $(`.folder_${siglas}`).click(consulta_folder);
            $(`.folder_MT_${siglas}`).click(consulta_folder_MT);
            $(`.folder_${siglas}`).click(function() {
                $(`#panel_${siglas}`).show();
                $(`#recargar_${siglas}`).click(recargar);
            });
            $(`.folder_MT_${siglas}`).click(function() {
                $(`#panel_${siglas}`).show();
                $(`#recargar_${siglas}`).click(recargar);
            });
            if (cargo != "SIG") {
                $(".eliminarCarpeta").hide();
            }
        }
    });

    $(".new_folder_" + siglas).click(consulta_sub_folder);

    function consulta_sub_folder() {
        var ruta = $(this).attr("data-ruta");
        var direc = $(this).attr("data-consulta");
        var json = {
            'consulta': direc,
            'ruta': ruta,
            'id_proceso_fk': idProceso
        };
        Swal.fire({
            title: '<span class="title">Creación de la Carpeta</span>',
            input: 'text',
            showCancelButton: true,
        }).then(function(result) {
            var select = '<form action="#" class="select_folder_' + siglas + '">';
            select += '<div class="form-group">';
            select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
            select += '<select class="form-control" id="select" name="carpeta">';
            $.ajax({
                type: "POST",
                data: json,
                url: 'php/selectSwal.php',
                success: function(data) {
                    $("#select").html(data);
                }
            });
            select += '</select>';
            select += '</div>';
            select += '</form>';

            Swal.fire({
                title: "Destino",
                html: select,
                showCancelButton: true
            }).then(function() {
                var direccion1 = $(".select_folder_" + siglas + " [name=carpeta]").val();
                var ruta = "/" + direccion1;
                var folder = result.value;
                var json = {
                    'folder': folder,
                    'direccion': ruta,
                    'id_proceso_fk': idProceso
                };
                $.ajax({
                    type: 'POST',
                    data: json,
                    url: 'php/new_folder.php',
                    success: function(data) {
                        if (data == "1") {
                            Swal.fire({
                                text: "Tu carpeta ha sido creada!",
                                icon: "success"
                            }).then((success) => {
                                listar_Descargas(cargo, siglas, idProceso);
                                ocultar_informacion();
                            });
                        } else {
                            Swal.fire({
                                text: data == "2" ? "OH! Tu carpeta Ya existe!" : "OH! Tu carpeta NO ha sido creada!",
                                icon: "error"
                            });
                        }
                    }
                });
            }).catch(Swal.noop);
        }).catch(Swal.noop);
    }

    function consulta_folder() {
        // Implementar similar a listar_Descargas con cambios de siglas y idProceso
    }

    function consulta_folder_MT() {
        // Implementar similar a listar_Descargas con cambios de siglas y idProceso
    }

    function recargar() {
        listar_Descargas(cargo, siglas, idProceso);
        $(`#panel_${siglas}`).hide();
    }

    function eliminar_registro() {
        // Implementar eliminación similar con cambios de siglas y idProceso
    }
}

function eliminarCarpeta() {
    var id = $(this).attr("data-id");
    var json = {
        'id': id
    }

    swal({
        title: "Estas Seguro?",
        text: "¡Una vez que se elimine, ¡no podrá recuperar esta Carpeta ni sus archivos!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Si, deseo hacerlo!',
        cancelButtonText: 'No, cancelar!',
        confirmButtonClass: 'confirm-class',
        cancelButtonClass: 'cancel-class',
    }).then(function() {
        $.ajax({
            type: 'POST',
            data: json,
            url: 'php/eliminar_carpeta.php',
            success: function(data) {
                if (data == "1") {
                    swal(
                        "OH! Tu archivo NO ha sido eliminado!",
                        "error"
                    );
                } else {
                    swal({
                        title: 'Borrado!',
                        text: "Tu archivo ha sido eliminado!",
                        type: "success"
                    }).then(function(success) {
                        location.reload();
                    });
                }
            }
        });
    }, function(dismiss) {
        if (dismiss === 'cancel') {
            swal({
                title: 'Cancelado',
                text: "Has cancelado la eliminación!",
                type: "error"
            });
        }
    }).catch(swal.noop);
}
