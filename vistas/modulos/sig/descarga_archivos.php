<style>
.boton {
    border: 1px solid #2e518b;
    padding: 10px;
    background-color: #2e518b;
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase;
    font-family: 'Helvetica', sans-serif;
    border-radius: 50px;
}    
</style>

<?php
if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
    exit("Archivo no especificado.");
}

$archivo = basename($_GET['archivo']);
$direc = $_GET['ruta'];
$ruta = $_SERVER['DOCUMENT_ROOT'] . '/MVC-ZFIP/' . $direc;
$ext = pathinfo($direc, PATHINFO_EXTENSION);

// Verificar si el archivo existe
if (!file_exists($ruta)) {
    die("El archivo no existe: " . realpath($ruta));
}

if ($ext === "pdf") {
    // Limpiar salida previa
    ob_end_clean();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=" . $archivo);
    header("Content-Length: " . filesize($ruta));
    readfile($ruta);
    exit();
} else {
    // Leer archivos Word, Excel, PowerPoint
    echo '<center>
        <a href="descarga_final.php?archivo=' . urlencode($archivo) . '&ruta=' . urlencode($direc) . '">
            <button class="boton">Descargar</button>
        </a>
    </center><hr>';

    echo '<iframe src="http://docs.google.com/gview?url=http://192.168.1.164/MVC-ZFIP/' . urlencode($direc) . '&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
}
?>
