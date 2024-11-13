<?php
// Incluir la conexión a la base de datos
// Configuración de la base de datos
$host = 'localhost';
$db = 'encuesta_bd';
$user = 'root'; // Cambia esto si usas otro usuario
$pass = '12345678'; // Cambia esto si tienes contraseña
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}


// Verificar si se recibió el ID de la encuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $encuestaId = $_POST['id'];

    // Validar que el ID sea un número entero
    if (!filter_var($encuestaId, FILTER_VALIDATE_INT)) {
        echo json_encode(['error' => 'ID inválido']);
        exit;
    }

    // Preparar y ejecutar la consulta para eliminar la encuesta
    $query = "DELETE FROM encuestas WHERE id = :id";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute(['id' => $encuestaId]);
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => 'Encuesta eliminada correctamente']);
        } else {
            echo json_encode(['error' => 'No se encontró la encuesta']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar la encuesta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Solicitud inválida']);
}
?>







