<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surveyTitle = htmlspecialchars($_POST['surveyTitle']);
    $surveyDescription = htmlspecialchars($_POST['surveyDescription']);
    $questions = $_POST['questions'];

    echo "<h1>Encuesta: $surveyTitle</h1>";
    echo "<p>$surveyDescription</p>";

    echo "<form action='guardar_respuestas.php' method='POST'>";

    foreach ($questions as $index => $question) {
        $questionText = htmlspecialchars($question['text']);
        $questionType = htmlspecialchars($question['type']);
        
        echo "<h3>Pregunta $index: $questionText</h3>";
        echo "<p>Tipo: $questionType</p>";

        // Mostrar el campo según el tipo de pregunta
        if ($questionType === 'abierta') {
            // Pregunta abierta - input de texto
            echo "<input type='text' name='respuestas[$index]' placeholder='Tu respuesta'><br><br>";
        } elseif ($questionType === 'multiple') {
            // Opción múltiple - radio buttons
            if (isset($question['options'])) {
                foreach ($question['options'] as $optionIndex => $option) {
                    $optionText = htmlspecialchars($option);
                    echo "<input type='radio' name='respuestas[$index]' value='$optionText'> $optionText<br>";
                }
                echo "<br>";
            }
        } elseif ($questionType === 'seleccion') {
            // Casilla de selección - checkboxes
            if (isset($question['options'])) {
                foreach ($question['options'] as $optionIndex => $option) {
                    $optionText = htmlspecialchars($option);
                    echo "<input type='checkbox' name='respuestas[$index][]' value='$optionText'> $optionText<br>";
                }
                echo "<br>";
            }
        }
    }

    echo "<button type='submit'>Enviar Respuestas</button>";
    echo "</form>";
} else {
    echo "<p>No se envió ninguna encuesta.</p>";
}
?>
