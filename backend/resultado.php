<?php
session_start();
include './config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surveyTitle = htmlspecialchars($_POST['surveyTitle']);
    $surveyDescription = htmlspecialchars($_POST['surveyDescription']);
    $questions = $_POST['questions'];

    // Crear una estructura para la encuesta
    $survey = [
        'title' => $surveyTitle,
        'description' => $surveyDescription,
        'questions' => []
    ];

    foreach ($questions as $index => $question) {
        $questionText = htmlspecialchars($question['text']);
        $questionType = htmlspecialchars($question['type']);

        // Agregar la pregunta a la estructura JSON
        $questionData = [
            'text' => $questionText,
            'type' => $questionType,
            'options' => []
        ];

        if (isset($question['options'])) {
            foreach ($question['options'] as $optionIndex => $option) {
                $questionData['options'][] = htmlspecialchars($option);
            }
        }

        $survey['questions'][] = $questionData;
    }

    // Convertir la encuesta en JSON
    $surveyJSON = json_encode($survey, JSON_PRETTY_PRINT);

    // Generar título y descripción aleatorios (puedes personalizar esto)
    $randomTitle = "Encuesta " . rand(1000, 9999);
    $randomDescription = "Descripción generada automáticamente " . rand(1000, 9999);

    // Usar un token predefinido
    $token = $_SESSION["token"];

    // ID del usuario predefinido
    $userId = $_SESSION["usuario_id"];

    // Insertar la encuesta en la base de datos
    $stmt = $conn->prepare("INSERT INTO encuestas (titulo, descripcion, token, estructura, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $randomTitle, $randomDescription, $token, $surveyJSON, $userId);

    if ($stmt->execute()) {
        echo "<h2>Encuesta guardada correctamente.</h2>";
        echo "<p>ID de la encuesta: " . $stmt->insert_id . "</p>";
    } else {
        echo "Error al guardar la encuesta: " . $stmt->error;
    }

    $stmt->close();

    // Mostrar la estructura JSON de la encuesta debajo del formulario
    echo "<h2>Estructura JSON de la Encuesta Guardada:</h2>";
    echo "<pre>" . $surveyJSON . "</pre>";

    header("Location: ../frontend/index.php");
} else {
    echo "<p>No se envió ninguna encuesta.</p>";
}

$conn->close();
?>
