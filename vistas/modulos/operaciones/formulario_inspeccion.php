<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento con Firma - By Parzibyte</title>
</head>

<body>
    <h3>Firma del Operador</h3>
    <canvas id="canvasOperador"></canvas>
    <br>
    <button id="btnLimpiarOperador">Limpiar</button>
    <button id="btnDescargarOperador">Descargar</button>
    <br><br>

    <h3>Firma del Usuario de Zona Franca</h3>
    <canvas id="canvasZonaFranca"></canvas>
    <br>
    <button id="btnLimpiarZonaFranca">Limpiar</button>
    <button id="btnDescargarZonaFranca">Descargar</button>
    <br><br>

    <button id="btnGenerarDocumento">Pasar a documento</button>

    <script>
        function inicializarCanvas(canvasId, btnLimpiarId, btnDescargarId, nombreArchivo) {
            const canvas = document.getElementById(canvasId);
            const contexto = canvas.getContext("2d");
            const COLOR_PINCEL = "black";
            const COLOR_FONDO = "white";
            const GROSOR = 2;
            let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
            let haComenzadoDibujo = false;

            const obtenerXReal = (clientX) => clientX - canvas.getBoundingClientRect().left;
            const obtenerYReal = (clientY) => clientY - canvas.getBoundingClientRect().top;

            // Configura el fondo blanco al iniciar
            const limpiarCanvas = () => {
                contexto.fillStyle = COLOR_FONDO;
                contexto.fillRect(0, 0, canvas.width, canvas.height);
            };
            limpiarCanvas();

            // Evento de limpiar el canvas
            document.getElementById(btnLimpiarId).onclick = limpiarCanvas;

            // Evento de descargar la firma
            document.getElementById(btnDescargarId).onclick = () => {
                const enlace = document.createElement('a');
                enlace.download = nombreArchivo + ".png";
                enlace.href = canvas.toDataURL();
                enlace.click();
            };

            // Inicio del dibujo en el canvas
            const onClicOToqueIniciado = evento => {
                xAnterior = xActual;
                yAnterior = yActual;
                xActual = obtenerXReal(evento.clientX);
                yActual = obtenerYReal(evento.clientY);
                contexto.beginPath();
                contexto.fillStyle = COLOR_PINCEL;
                contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
                contexto.closePath();
                haComenzadoDibujo = true;
            }

            // Dibujo continuo
            const onMouseODedoMovido = evento => {
                evento.preventDefault();
                if (!haComenzadoDibujo) return;
                let target = evento;
                if (evento.type.includes("touch")) {
                    target = evento.touches[0];
                }
                xAnterior = xActual;
                yAnterior = yActual;
                xActual = obtenerXReal(target.clientX);
                yActual = obtenerYReal(target.clientY);
                contexto.beginPath();
                contexto.moveTo(xAnterior, yAnterior);
                contexto.lineTo(xActual, yActual);
                contexto.strokeStyle = COLOR_PINCEL;
                contexto.lineWidth = GROSOR;
                contexto.stroke();
                contexto.closePath();
            }

            // Fin del dibujo
            const onMouseODedoLevantado = () => {
                haComenzadoDibujo = false;
            };

            ["mousedown", "touchstart"].forEach(evento => {
                canvas.addEventListener(evento, onClicOToqueIniciado);
            });
            ["mousemove", "touchmove"].forEach(evento => {
                canvas.addEventListener(evento, onMouseODedoMovido);
            });
            ["mouseup", "touchend"].forEach(evento => {
                canvas.addEventListener(evento, onMouseODedoLevantado);
            });
        }

        // Inicializar ambas áreas de firma
        inicializarCanvas("canvasOperador", "btnLimpiarOperador", "btnDescargarOperador", "FirmaOperador");
        inicializarCanvas("canvasZonaFranca", "btnLimpiarZonaFranca", "btnDescargarZonaFranca", "FirmaZonaFranca");

        // Función para generar documento
        document.getElementById("btnGenerarDocumento").onclick = () => {
            window.open("documento.html");
        };
    </script>
</body>

</html>
