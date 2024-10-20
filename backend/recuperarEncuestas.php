<?php
session_start(); 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario_id"])) {
    echo json_encode(["error" => "Usuario no autenticado."]);
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'crud_db';
$user = 'root';
$pass = '12345678';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID del usuario desde la sesión
    $usuario_id = $_SESSION["usuario_id"];

    // Consulta para obtener las encuestas del usuario
    $stmt = $pdo->prepare("SELECT id, titulo, descripcion FROM encuestas WHERE user_id = ?");
    $stmt->execute([$usuario_id]);

    $encuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($encuestas);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
