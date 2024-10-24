<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuestas = $_POST['respuestas'];

    echo "<h1>Respuestas Recibidas</h1>";

    // Crear un array para almacenar las respuestas en JSON
    $surveyResponses = [];

    foreach ($respuestas as $index => $respuesta) {
        echo "<h3>Pregunta $index:</h3>";

        if (is_array($respuesta)) {
            // Caso de casillas de selección (checkboxes)
            echo "<ul>";
            foreach ($respuesta as $opcion) {
                echo "<li>" . htmlspecialchars($opcion) . "</li>";
            }
            echo "</ul>";

            // Agregar las respuestas de checkboxes al array JSON
            $surveyResponses[$index] = $respuesta;
        } else {
            // Caso de respuesta abierta o opción múltiple
            echo "<p>" . htmlspecialchars($respuesta) . "</p>";

            // Agregar la respuesta única al array JSON
            $surveyResponses[$index] = $respuesta;
        }
    }

    // Mostrar las respuestas en formato JSON debajo del formulario
    echo "<h2>Estructura JSON de las Respuestas:</h2>";
    echo "<pre>" . json_encode($surveyResponses, JSON_PRETTY_PRINT) . "</pre>";
} else {
    echo "<p>No se recibieron respuestas.</p>";
}
?>
