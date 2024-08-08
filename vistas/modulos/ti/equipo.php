<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Mantenimiento Equipo de computo</li>
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
                        <h3 class="widget-user-username flex-grow-1"><B>MANTENIMIENTO PREVENTIVO EQUIPOS DE COMPUTO</B></h3>
                    </div>
                    <div class="card card-info">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <br>
                                    <div class="col-6"><br>
                                        <label for="fecha_mantenimiento">Fecha</label>
                                        <input type="date" name="fecha_mantenimiento" class="form-control" id="fecha_mantenimiento" required>
                                    </div>
                                    <div class="col-6"><br>
                                        <label for="id_usuario_fk">Responsable</label>
                                        <input list="usuarios" class="form-control select2 " id="id_usuario_fk" name="id_usuario_fk" required style="width: 100%;">
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
                                    <div class="col-md-12"><br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Equipo de Computo</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="marca">Marca</label>
                                        <input type="text" class="form-control" id="marca" name="marca">
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="modelo">Modelo</label>
                                        <input id="modelo" name="modelo" class="form-control" placeholder="modelo" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="serie">Serie</label>
                                        <input id="serie" name="serie" class="form-control" placeholder="serie" required>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="usuario_equipo">Nombre de Usuario</label>
                                        <input id="usuario_equipo" name="usuario_equipo" class="form-control" placeholder="Nombre usuario" required>
                                    </div>
                                    <div class="col-md-12"><br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Equipo de Computo</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="soplar_partes_externas">Soplar partes externas, equipo completo y área de trabajo, telefono.</label>
                                        <select class="form-control" id="soplar_partes_externas" name="soplar_partes_externas">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="lubricar_puertos">Lubricar puertos, conectores, contactos y bisagras con CRC o 3 en 1, isopropilico</label>
                                        <select class="form-control" id="lubricar_puertos" name="lubricar_puertos">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="limpieza_equipo">Limpieza de equipo completo, cables y accesorios</label>
                                        <select class="form-control" id="limpieza_equipo" name="limpieza_equipo">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="limpiar_partes_interna">Soplar y limpiar partes interna equipo completo.</label>
                                        <select class="form-control" id="limpiar_partes_interna" name="limpiar_partes_interna">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="verificar_usuario">Verificar usuario estandar y administrador.</label>
                                        <select class="form-control" id="verificar_usuario" name="verificar_usuario">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="contra">Verificar Contraseñas</label>
                                        <select class="form-control" id="contra" name="contra">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="formato_asignacion_equipo">Verificar y constatar elementos del formato asignación de equipos</label>
                                        <select class="form-control" id="formato_asignacion_equipo" name="formato_asignacion_equipo">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="depurar_temporales">Depurar temporales, vaciar Visor de Eventos (temp/ %temp%)</label>
                                        <select class="form-control" id="depurar_temporales" name="depurar_temporales">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="liberar_espacio">Liberar espacio en disco</label>
                                        <select class="form-control" id="liberar_espacio" name="liberar_espacio">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="desinstalar_programas">Desinstalar programas innecesarios (navegadores y otros programas)</label>
                                        <select class="form-control" id="desinstalar_programas" name="desinstalar_programas">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="actualizar_logos">Actualizar logos (Firma, facturación y logueo)</label>
                                        <select class="form-control" id="actualizar_logos" name="actualizar_logos">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="verificar_actualizaciones">Verificar actualizaciones Windows, Office, Java, Flash, Adobe, Antivirus y otros.</label>
                                        <select class="form-control" id="verificar_actualizaciones" name="verificar_actualizaciones">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="desfragmentar">Desfragmentar disco duro (HDD) - unidades tradicionales (no SDD)</label>
                                        <select class="form-control" id="desfragmentar" name="desfragmentar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12"><br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Equipo de Computo</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="usuario">Usuario</label>
                                        <select class="form-control" id="usuario" name="usuario">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="clave">Clave</label>
                                        <select class="form-control" id="clave" name="clave">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="estandar">Usuario estandar</label>
                                        <select class="form-control" id="estandar" name="estandar">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="administrador">Usuario Administrador</label>
                                        <select class="form-control" id="administrador" name="administrador">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12"><br>
                                        <div class="card card-info collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Equipo de Computo</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="analisis_completo">Análisis completo de equipo antivirus, antimalware</label>
                                        <select class="form-control" id="analisis_completo" name="analisis_completo">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="bloqueo_usb">Bloqueo de puertos USB</label>
                                        <select class="form-control" id="bloqueo_usb" name="bloqueo_usb">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="dominio_zfip">Enrolar equipo en el dominio ZFIP</label>
                                        <select class="form-control" id="dominio_zfip" name="dominio_zfip">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="apagar_pantalla">Apagar pantalla en tiempo prudente (10 minutos)</label>
                                        <select class="form-control" id="apagar_pantalla" name="apagar_pantalla">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="estado_suspension">Estado Suspensión o hibernación correcta (20 minutos)</label>
                                        <select class="form-control" id="estado_suspension" name="estado_suspension">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                    <div class="col-3" hidden><br>
                                        <label for="firma">Firma del usuario</label>
                                        <input type="file" id="firma" name="firma" accept="image/*">
                                    </div>
                                    <div class="col-3"><br>
                                        <label for="">Estado del mantenimiento</label>
                                        <input id="estado_mantenimiento_equipo" name="estado_mantenimiento_equipo" class="form-control" value="Sin Firmar" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            <?php
                            $crearMantenimiento = new ControladorMantenimiento();
                            $crearMantenimiento->ctrCrearMantenimiento();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>