<?php
include './config/conn.php';

// Establece la conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener la encuesta
$token = $_GET['token']; // Asume que el token se envía en la solicitud
$sql = "SELECT estructura, respuestas FROM encuestas WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $estructura = json_decode($row['estructura'], true);
    $respuestas = json_decode($row['respuestas'], true);

    // Combina la estructura y las respuestas
    $response = [
        "title" => $estructura['title'],
        "description" => $estructura['description'],
        "questions" => $estructura['questions'],
        "answers" => $respuestas
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo json_encode(["error" => "No se encontró la encuesta."]);
}

$stmt->close();
$conn->close();
?>
