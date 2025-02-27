<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pintar Caracteres en Tabla</title>

    <!--ESTOS ESTILOS CAMBIAN EL TIPO DE LETRA DE LAS TABLAS DE ESTE MODULO
    <style>
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            width: 20px;
            height: 20px;
            font-family: monospace;
            
        }
        .highlight {
            background-color: yellow;
            color: black;
            font-weight: bold;;
        }
    </style>-->
</head>
<body>
    <form method="POST">
        <label for="word">Ingresa una palabra:</label>
        <input type="text" id="word" name="word" required>
        <button type="submit">Pintar caracteres</button>
    </form>

    <table>
        <?php
        // Todos los caracteres posibles en líneas separadas
        $charLines = [
            'A B C D E F G H I J K L M',
            'N O P Q R S T U V W X Y Z',
            'a b c d e f g h i j k l m',
            'n o p q r s t u v w x y z',
            '0 1 2 3 4 5 6 7 8 9 ! ¡ "',
            '# $ % & / ( ) = ? ¿ * + [',
            '] { } > < . _ - \\ @ , ; °'
        ];

        // Verifica si se ha enviado una palabra
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['word'])) {
            $word = $_POST['word'];
            $highlightedChars = str_split($word);
        } else {
            $highlightedChars = [];
        }

        // Itera sobre cada línea de caracteres
        foreach ($charLines as $line) {
            echo '<tr>';
            $chars = explode(' ', $line); // Divide la línea en caracteres individuales
            foreach ($chars as $char) {
                // Si el carácter está en la palabra, aplica la clase de resaltado
                $class = in_array($char, $highlightedChars) ? 'highlight' : '';
                echo "<td class='$class'>$char</td>";
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>
