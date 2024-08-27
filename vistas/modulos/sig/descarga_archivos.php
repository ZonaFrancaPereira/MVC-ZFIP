<style>
.boton {
    border: 1px solid #2e518b; /*anchura, estilo y color borde*/
    padding: 10px; /*espacio alrededor texto*/
    background-color: #2e518b; /*color botón*/
    color: #ffffff; /*color texto*/
    text-decoration: none; /*decoración texto*/
    text-transform: uppercase; /*capitalización texto*/
    font-family: 'Helvetica', sans-serif; /*tipografía texto*/
    border-radius: 50px; /*bordes redondos*/
}
</style>

<?php
// Si la variable archivo que pasamos por URL no está establecida, acabamos la ejecución del script.
if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
    exit('No se ha especificado un archivo.');
}

// Utilizamos basename por seguridad, devuelve el nombre del archivo eliminando cualquier ruta.
$archivo = basename($_GET['archivo']);
$direc = $_GET['ruta'];

// Generar la ruta absoluta del archivo en el sistema de archivos del servidor.
$ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . $direc;
//$ruta = $_SERVER['DOCUMENT_ROOT'] . '/MVC-ZFIP/' . $direc;

// PATCHINFO: sirve para extraer la extensión del archivo y así crear la condición para visualizarlo.
$ext = pathinfo($direc, PATHINFO_EXTENSION);

// Verificar si el archivo existe antes de intentar acceder a él.
if (!file_exists($ruta)) {
    die('El archivo no existe en la ruta especificada: ' . $ruta);
}

if ($ext == "pdf") {
    // Leer archivos PDF
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=" . $archivo);
    header("Content-Length: " . filesize($ruta));
    readfile($ruta);
} else {
    // Leer archivos Excel, Word, PowerPoint
    $url = 'http://localhost/MVC-ZFIP/' . $direc;
    echo '<center>
    <a href="descarga_final.php?archivo=' . $archivo . '&ruta=' . $direc . '" ><button class="boton">Descargar</button></a>
    </center><hr>';
    $encoded_url = urlencode("http://localhost/MVC-ZFIP/" . $direc); // Asegúrate de que la URL sea accesible
echo '<iframe src="https://docs.google.com/gview?url=' . urlencode($encoded_url) . '&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
}
?>