<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

// Conexión a la base de datos (ajusta las credenciales si es necesario)
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "encuesta_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$user_id = $_SESSION['usuario_id'];
$sql = "SELECT id, token, estructura FROM encuestas WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$encuestas = [];

while ($row = $result->fetch_assoc()) {
    $estructura = json_decode($row['estructura'], true);
    $titulo = $estructura['title'] ?? 'Sin título';
    $descripcion = $estructura['description'] ?? 'Sin descripción';

    $encuestas[] = [
        'id' => $row['id'],
        'token' => $row['token'],
        'titulo' => $titulo,
        'descripcion' => $descripcion
    ];
}

$stmt->close();
$conn->close();

// Enviar la respuesta en formato JSON
echo json_encode($encuestas);
?>
