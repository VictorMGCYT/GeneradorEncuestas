
<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

// Procesar las respuestas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $respuestas = $_POST['respuestas'];

    // las respuestas y guardarlas en la base de datos
    // Ejemplo:
    // foreach ($respuestas as $index => $respuesta) {
    //     echo "Pregunta $index: Respuesta: $respuesta <br>";
    // }

    echo "Respuestas guardadas con éxito.";
} else {
    echo "Método no permitido.";
}
?>
