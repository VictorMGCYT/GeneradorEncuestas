<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuestas = $_POST['respuestas'];

    echo "<h1>Respuestas Recibidas</h1>";

    foreach ($respuestas as $index => $respuesta) {
        echo "<h3>Pregunta $index:</h3>";

        if (is_array($respuesta)) {
            // Caso de casillas de selección (checkboxes)
            echo "<ul>";
            foreach ($respuesta as $opcion) {
                echo "<li>" . htmlspecialchars($opcion) . "</li>";
            }
            echo "</ul>";
        } else {
            // Caso de respuesta abierta o opción múltiple
            echo "<p>" . htmlspecialchars($respuesta) . "</p>";
        }
    }
} else {
    echo "<p>No se recibieron respuestas.</p>";
}
?>
