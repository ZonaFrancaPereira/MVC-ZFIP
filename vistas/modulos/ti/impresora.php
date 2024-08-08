<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Mantenimiento Impresoras</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer">
                    <div class="row text-center pb-3">
                        <h3 class="widget-user-username flex-grow-1"><B>MANTENIMIENTO PREVENTIVO IMPRESORAS</B></h3>
                    </div>
                    <div class="card card-info">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <br>
                                    <div class="col-6"><br>
                                        <label for="fecha_mantenimiento_impresora">Fecha</label>
                                        <input type="date" name="fecha_mantenimiento_impresora" class="form-control" id="fecha_mantenimiento_impresora" required>
                                    </div>
                                    <div class="col-6"><br>
                                        <label for="id_usuario_fk2">Responsable</label>
                                        <input list="usuarios" class="form-control select2 " id="id_usuario_fk2" name="id_usuario_fk2" required style="width: 100%;">
                                        <datalist id="usuarios">
                                            <?php
                                            if ($usuario["id"] <> 0) {
                                                echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                            }
                                            $item = null;
                                            $valor = null;
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                            foreach ($usuario as $key => $value) {
                                                echo '<option value="' . $value["id"] . '"> ' . $value["nombre"] . $value["apellidos_usuario"] . ' </option>';
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="col-md-12"> <br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">IMPRESORA</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="nombre_impresora">Nombre de la Impresora</label>
                                        <input id="nombre_impresora" name="nombre_impresora" class="form-control" placeholder="Nombre impresora" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="marca_impresora">Marca</label>
                                        <input type="text" class="form-control" id="marca_impresora" name="marca_impresora">
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="modelo_impresora">Modelo</label>
                                        <input id="modelo_impresora" name="modelo_impresora" class="form-control" placeholder="modelo" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="serial_impresora">Serial</label>
                                        <input id="serial_impresora" name="serial_impresora" class="form-control" placeholder="serial" required>
                                    </div>
                                    <div class="col-md-12"> <br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">IMPRESORA</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="soplar_exterior">Soplar y limpiar el exterior de la impresora</label>
                                        <select class="form-control" id="soplar_exterior" name="soplar_exterior">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="isopropilico">Limpiar el interior de la impresora con alcohol isopropilico</label>
                                        <select class="form-control" id="isopropilico" name="isopropilico">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="toner">Revisar los niveles de tinta o tóner.</label>
                                        <select class="form-control" id="toner" name="toner">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="alinear">Alinear el cabezal de impresión y ajustar la calidad de impresión </label>
                                        <select class="form-control" id="alinear" name="alinear">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="verificar_cableado">Verificar que todos los cables estén correctamente conectados y en buen estado</label>
                                        <select class="form-control" id="verificar_cableado" name="verificar_cableado">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="rodillos">Limpiar los rodillos de alimentación del papel con un paño húmedo.</label>
                                        <select class="form-control" id="rodillos" name="rodillos">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="reemplazar">Reemplazar los cartuchos de tinta o tóner según sea necesario</label>
                                        <select class="form-control" id="reemplazar" name="reemplazar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="limpiar">Ejecutar la función de limpieza del cabezal de impresión para eliminar posibles obstrucciones.</label>
                                        <select class="form-control" id="limpiar" name="limpiar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="imprimir">Imprimir una página de prueba para verificar que la impresora funcione correctamente.</label>
                                        <select class="form-control" id="imprimir" name="imprimir">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="verificar">Verificar el funcionamiento de las funciones adicionales de la impresora, como la escaneo o la copia, si están disponibles en los equipos</label>
                                        <select class="form-control" id="verificar" name="verificar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br><br><br>
                                        <label for="estado_mantenimiento_impresora">Estado</label>
                                        <input list="browsers" id="estado_mantenimiento_impresora" name="estado_mantenimiento_impresora" class="form-control" value="Sin Firmar" readonly>
                                    </div>
                                    <div class="col-3">
                                    </div>
                                    <div class="col-md-3 col-xs-3 col-sm-3"><br>
                                        <br>
                                        <button type="submit" class="btn bg-info btn-block" id="enviar_formulario_impresoras" name="enviar_formulario_impresoras" onclick="enviarFormularioImpresoras()">ENVIAR</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $crearMantenimiento = new ControladorMantenimiento();
                            $crearMantenimiento->ctrCrearMantenimientoImpresora();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>