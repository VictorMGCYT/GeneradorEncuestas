<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $respuestas = $_POST['respuestas'];

    // Conectar a la base de datos
    include '../backend/config/conn.php';

    if ($conn->connect_error) {
        die('Error de conexión (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }

    // Buscar el ID de la encuesta utilizando el token
    $stmt = $conn->prepare("SELECT id FROM encuestas WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($encuesta_id);
    $stmt->fetch();
    $stmt->close();

    if (!$encuesta_id) {
        echo "Encuesta no encontrada.";
        exit();
    }

    // Convertir las respuestas a formato JSON
    $respuestas_json = json_encode($respuestas, JSON_UNESCAPED_UNICODE);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error al codificar las respuestas en JSON.";
        exit();
    }

    // Insertar las respuestas en la tabla respuestas
    $stmt = $conn->prepare("INSERT INTO respuestas (respuesta, encuesta_id) VALUES (?, ?)");
    $stmt->bind_param("si", $respuestas_json, $encuesta_id);

    if ($stmt->execute()) {
        echo "Respuestas guardadas con éxito.";
        echo "Se reenviará a la pantalla de inicio";
        echo "<script> alert('Ir a home'); </script>";
        header("Location: ../frontend/index.php");
    } else {
        echo "Error al guardar las respuestas: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
