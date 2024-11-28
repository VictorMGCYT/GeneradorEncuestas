<?php
header('Content-Type: application/json');

$encuesta_id = $_GET['encuesta_id'] ?? null;

$host = 'localhost';
$dbname = 'encuesta_bd';
$username = 'root';
$password = '12345678';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($encuesta_id) {
        // Obtener la estructura de la encuesta
        $stmt = $pdo->prepare("SELECT estructura FROM encuestas WHERE id = ?");
        $stmt->execute([$encuesta_id]);
        $encuesta = $stmt->fetch(PDO::FETCH_ASSOC);

        // Obtener respuestas de la encuesta
        $stmt = $pdo->prepare("SELECT respuesta, fecha_creacion FROM respuestas WHERE encuesta_id = ?");
        $stmt->execute([$encuesta_id]);
        $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $estructura = json_decode($encuesta['estructura'], true);
        $questions = $estructura['questions'] ?? [];

        // Combinar preguntas con respuestas
        $data = [];
        foreach ($questions as $index => $question) {
            $data[] = [
                'question' => $question['text'],
                'type' => $question['type'],
                'responses' => array_map(function ($respuesta) use ($index) {
                    $decoded = json_decode($respuesta['respuesta'], true);
                    return $decoded[$index] ?? '';
                }, $respuestas),
            ];
        }

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
