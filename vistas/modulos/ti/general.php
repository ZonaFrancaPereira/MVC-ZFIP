<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Mantenimiento Generales </li>
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
                        <h3 class="widget-user-username flex-grow-1"><B>MANTENIMIENTO PREVENTIVO GENERAL</B></h3>
                    </div>
                    <div class="card card-info">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <br>
                                    <div class="col-6"><br>
                                        <label for="fecha_mantenimiento3">Fecha</label>
                                        <input type="date" name="fecha_mantenimiento3" class="form-control" id="fecha_mantenimiento3" required>
                                    </div>
                                    <div class="col-6"><br>
                                        <label for="id_usuario_fk3">Responsable</label>
                                        <input list="usuarios" class="form-control select2 " id="id_usuario_fk3" name="id_usuario_fk3" required style="width: 100%;">
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
                                                <h3 class="card-title">GENERAL</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="articulo">Articulo</label>
                                        <input list="browsers" id="articulo" name="articulo" class="form-control" placeholder="Nombre impresora" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="marca_general">Marca</label>
                                        <input type="text" class="form-control" id="marca_general" name="marca_general">
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="modelo_general">Modelo</label>
                                        <input list="browsers" id="modelo_general" name="modelo_general" class="form-control" placeholder="modelo" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="serial_general">Serial</label>
                                        <input list="browsers" id="serial_general" name="serial_general" class="form-control" placeholder="serial" required>
                                    </div>
                                    <div class="col-md-12"> <br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">GENERAL</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="partes_externas">Soplar y limpiar partes externas (Utilizar insumos adecuadados para el dispositivo / articulo)</label>
                                        <select class="form-control" id="partes_externas" name="partes_externas">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="condiciones_fisicas">Verificar las condiciones fisicas del dispositivo / articulo</label>
                                        <select class="form-control" id="condiciones_fisicas" name="condiciones_fisicas">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="cableado_verificar">Dependiendo del dispositivo si cuenta con cableado verificar su estado, limpiar y organizar cableado.</label>
                                        <select class="form-control" id="cableado_verificar" name="cableado_verificar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br><br>
                                        <label for="dispositivo">Soplar y limpiar lugar donde se encuentra ubicado el dispositivo / articulo </label>
                                        <select class="form-control" id="dispositivo" name="dispositivo">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="estado_general">Estado</label>
                                        <input id="estado_general" name="estado_general" class="form-control" value="Sin Firmar" readonly>
                                    </div>
                                    <div class="col-md-3 col-xs-3 col-sm-3"><br>
                                        <br>
                                        <button type="submit" class="btn bg-info btn-block" id="enviar_formulario_general" name="enviar_formulario_general" onclick="enviarFormularioGeneral()">ENVIAR</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $crearMantenimiento = new ControladorMantenimiento();
                            $crearMantenimiento->ctrCrearMantenimientoGeneral();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>