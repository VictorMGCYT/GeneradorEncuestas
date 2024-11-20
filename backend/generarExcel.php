<?php
// archivo: get_encuesta_respuestas.php
header('Content-Type: application/json');

$encuesta_id = $_GET['encuesta_id'] ?? null;

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'encuesta_bd';
$username = 'root';
$password = '12345678';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($encuesta_id) {
        $stmt = $pdo->prepare("SELECT id, respuesta, fecha_creacion FROM respuestas WHERE encuesta_id = ?");
        $stmt->execute([$encuesta_id]);
        $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $respuestas = [];
    }

    echo json_encode($respuestas);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}