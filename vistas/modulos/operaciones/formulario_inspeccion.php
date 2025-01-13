<form id="GuardarInspeccion" role="form" method="post" enctype="multipart/form-data">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header bg-primary">
                <h3 class="card-title">ACTA DE INSPECCIÓN DE MERCANCÍAS</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label>Usuario ZFIP:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-users"></i></span>
                            </div>
                            <input class="form-control" name="id_cliente_fk" id="id_cliente_fk" list="ClientesList" placeholder="Seleccionar Cliente" required>
                        </div>
                        <datalist id="ClientesList">
                            <?php
                            $item = null;
                            $valor = null;
                            $clientes_zfip = ControladorClientes::ctrMostrarClientes($item, $valor);
                            foreach ($clientes_zfip as $key => $value) {
                                echo '<option value="' . $value["id_cliente"] . '">' . $value["id_cliente"] . '-' . $value["nombre_cliente"] . '</option>';
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="ingreso_salida">Ingreso o Salida:</label>
                        <select id="ingreso_salida" name="ingreso_salida" class="form-control">
                            <option value="ingreso">Ingreso</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                </div>

                <fieldset class="border p-3 mb-4">
                    <legend class="w-auto">TIPO DE OPERACIÓN</legend>
                    <div class="row">
                        <!-- Checkbox items for different operations -->
                        <!-- Planilla de Traslado -->

                        <!-- DTA, DTAI, CV -->
                        <div class="col-md-6 col-sm-6">
                        <label for="otro">Seleccione una opción:</label>
                            <input list="catego" class="form-control select2 " id="id_categoriaop" name="id_categoriaop_fk" required style="width: 100%;">
                            <datalist id="catego">
                                <?php
                                
                                $item = null;
                                $valor = null;
                                $categoriaop = ControladorInspeccion::ctrMostrarCategoriasOp($item, $valor);
                                foreach ($categoriaop as $key => $value) {
                                    echo '<option value="' . $value["id_categoriaop"] . '">  ' . $value["id_categoriaop"] .'-'. $value["nombre_categoriaop"] . ' </option>';
                                }
                                ?>
                            </datalist>

                        </div>

                        <!-- Otro -->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="otro">Otro (Especifique):</label>
                                <textarea name="otro" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Number inputs for transito, fmm, and arin -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label>NUMERO DE TRANSITO:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                            </div>
                            <input type="number" class="form-control" name="transito" id="transito" placeholder="Digite # de Transito" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label>NUMERO DE FMM:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                            </div>
                            <input type="number" class="form-control" name="fmm" id="fmm" placeholder="Digite # de FMM" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label>NUMERO DE ARIN:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                            </div>
                            <input type="number" class="form-control" name="arin" id="arin" placeholder="Digite # de ARIN" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Additional sections for cantidad de bultos, estado, descripción y observaciones, and autorización -->
                    <fieldset class="border p-3 mb-4 col-md-6">
                        <legend class="w-auto">CANTIDAD DE BULTOS</legend>
                        <div class="form-group">
                            <label for="documento">Documento:</label>
                            <input type="number" id="documento" name="documento" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="fisico">Físico:</label>
                            <input type="number" id="fisico" name="fisico" class="form-control">
                        </div>
                    </fieldset>

                    <fieldset class="border p-3 mb-4 col-md-6">
                        <legend class="w-auto">Estado</legend>
                        <div class="form-group text-center">
                            <div class="d-flex justify-content-center">
                                <div class="icheck-success d-inline mr-3">
                                    <input type="radio" name="estado" id="estadoBueno" value="bueno">
                                    <label for="estadoBueno">Bueno</label>
                                </div>
                                <div class="icheck-warning d-inline mr-3">
                                    <input type="radio" name="estado" id="estadoRegular" value="regular">
                                    <label for="estadoRegular">Regular</label>
                                </div>
                                <div class="icheck-danger d-inline">
                                    <input type="radio" name="estado" id="estadoMalo" value="malo">
                                    <label for="estadoMalo">Malo</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <fieldset class="border p-3 mb-4 col-md-12">
                    <legend class="w-auto">Descripción y Observaciones</legend>
                    <div class="form-group">
                        <textarea id="descripcion_observaciones" name="descripcion_observaciones" class="form-control"></textarea>
                    </div>
                </fieldset>

                <fieldset class="border p-3 mb-4 col-md-12">
                    <legend class="w-auto">AUTORIZACIÓN</legend>
                    <div class="row">
                        <div class="col-md-6 text-center" hidden>
                            <h3>Firma del Operador</h3>
                            <canvas id="canvasOperador" width="400" height="200" style="border:1px solid #000; margin-bottom: 10px;"></canvas>
                            <br>
                            <button type="button" id="btnLimpiarOperador" class="btn bg-warning">Limpiar</button>
                            <button type="button" id="btnDescargarOperador" class="btn btn-success" hidden>Descargar</button>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nombre_firma">Nombre:</label>
                            <input type="text" id="nombre_firma" name="nombre_firma" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cc_firma">C.C:</label>
                            <input type="text" id="cc_firma" name="cc_firma" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h3>Firma del Usuario de Zona Franca</h3>
                        <input type="hidden" name="base64" value="" id="base64">
                        <canvas id="canvasZonaFranca" width="400" height="200" style="border:1px solid #000; margin-bottom: 10px;"></canvas>
                        <br>
                        <button type="button" id="btnLimpiarZonaFranca" class="btn bg-warning">Limpiar</button>
                        <button type="button" id="btnDescargarZonaFranca" class="btn btn-success" hidden>Descargar</button>
                    </div>
                </fieldset>

                <button type="submit" class="btn bg-success btn-block">Guardar Inspección</button>
                <?php
                $crearInspeccion = new ControladorInspeccion();
                $crearInspeccion->ctrGuardarInspeccion();
                ?>
            </div>
        </div>
    </div>
</form>


<script>
    // Función para inicializar el canvas y asociar los eventos
    function inicializarCanvas(canvasId, btnLimpiarId, btnDescargarId, nombreArchivo, inputBase64Id) {
        const canvas = document.getElementById(canvasId);
        const contexto = canvas.getContext("2d");
        const COLOR_PINCEL = "black";
        const COLOR_FONDO = "white";
        const GROSOR = 2;
        let xAnterior = 0,
            yAnterior = 0,
            xActual = 0,
            yActual = 0;
        let haComenzadoDibujo = false;

        // Establece el color de fondo inicial del canvas
        const limpiarCanvas = () => {
            contexto.fillStyle = COLOR_FONDO;
            contexto.fillRect(0, 0, canvas.width, canvas.height);
        };
        limpiarCanvas(); // Limpia el canvas al cargar la página

        // Botón para limpiar el canvas
        document.getElementById(btnLimpiarId).onclick = limpiarCanvas;

        // Botón para descargar el contenido del canvas como una imagen PNG
        document.getElementById(btnDescargarId).onclick = () => {
            try {
                const imagenDataURL = canvas.toDataURL("image/png");
                if (imagenDataURL) {
                    const enlace = document.createElement('a');
                    enlace.href = imagenDataURL;
                    enlace.download = `${nombreArchivo}.png`;

                    // Solución para navegadores: agregar el enlace al DOM y hacer clic programático
                    document.body.appendChild(enlace);
                    enlace.click();
                    document.body.removeChild(enlace);
                } else {
                    alert("Error: No se pudo generar la imagen del canvas.");
                }
            } catch (error) {
                console.error("Error al descargar la imagen:", error);
                alert("Error al guardar la imagen. Verifica la consola para más detalles.");
            }
        };

        // Función para iniciar el dibujo
        const onClicOToqueIniciado = (evento) => {
            evento.preventDefault();
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = evento.clientX ? evento.clientX - canvas.getBoundingClientRect().left : evento.touches[0].clientX - canvas.getBoundingClientRect().left;
            yActual = evento.clientY ? evento.clientY - canvas.getBoundingClientRect().top : evento.touches[0].clientY - canvas.getBoundingClientRect().top;
            contexto.beginPath();
            contexto.fillStyle = COLOR_PINCEL;
            contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
            contexto.closePath();
            haComenzadoDibujo = true;
        };

        // Función para dibujar a medida que se mueve el mouse o el toque
        const onMouseODedoMovido = (evento) => {
            evento.preventDefault();
            if (!haComenzadoDibujo) return;
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = evento.clientX ? evento.clientX - canvas.getBoundingClientRect().left : evento.touches[0].clientX - canvas.getBoundingClientRect().left;
            yActual = evento.clientY ? evento.clientY - canvas.getBoundingClientRect().top : evento.touches[0].clientY - canvas.getBoundingClientRect().top;
            contexto.beginPath();
            contexto.moveTo(xAnterior, yAnterior);
            contexto.lineTo(xActual, yActual);
            contexto.strokeStyle = COLOR_PINCEL;
            contexto.lineWidth = GROSOR;
            contexto.stroke();
            contexto.closePath();
        };

        // Función para finalizar el dibujo
        const onMouseODedoLevantado = () => {
            haComenzadoDibujo = false;
        };

      

        // Event listeners para los distintos tipos de eventos
        canvas.addEventListener("mousedown", onClicOToqueIniciado);   // Mouse click
        canvas.addEventListener("touchstart", onClicOToqueIniciado); // Touch start
        canvas.addEventListener("mousemove", onMouseODedoMovido);    // Mouse move
        canvas.addEventListener("touchmove", onMouseODedoMovido);   // Touch move
        canvas.addEventListener("mouseup", onMouseODedoLevantado);  // Mouse up
        canvas.addEventListener("mouseout", onMouseODedoLevantado); // Mouse out
        canvas.addEventListener("touchend", onMouseODedoLevantado); // Touch end
        canvas.addEventListener("touchcancel", onMouseODedoLevantado); // Touch cancel
    }

    // Inicializar los canvas para cada firma
    window.onload = function() {
        // Asegúrate de pasar el id del input base64 para cada canvas
        inicializarCanvas("canvasOperador", "btnLimpiarOperador", "btnDescargarOperador", "Firma_Operador", "base64Operador");
        inicializarCanvas("canvasZonaFranca", "btnLimpiarZonaFranca", "btnDescargarZonaFranca", "Firma_Usuario_Zona_Franca", "base64ZonaFranca");
    };
</script>

<script>
    
    document.getElementById('GuardarInspeccion').addEventListener("submit",function(e){

var ctx = document.getElementById("canvasZonaFranca");
  var image = ctx.toDataURL(); // data:image/png....
  document.getElementById('base64').value = image;
},false);
</script>



<style>
    canvas {
        max-width: 100%;
        height: auto;
    }
</style>