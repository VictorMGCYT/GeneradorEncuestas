<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

// Verificar si se ha enviado el token
if (!isset($_GET['token'])) {
    echo "Token no proporcionado.";
    exit();
}

$token = $_GET['token'];

// Conectar a la base de datos
include '../backend/config/conn.php';

if ($conn->connect_error) {
    die('Error de conexión (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

// Recuperar la encuesta por el token
$stmt = $conn->prepare("SELECT estructura FROM encuestas WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->bind_result($estructura);
$stmt->fetch();
$stmt->close();

if (!$estructura) {
    echo "Encuesta no encontrada.";
    exit();
}

// Decodificar el JSON de la encuesta
$encuesta = json_decode($estructura, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error al decodificar el JSON de la encuesta.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Encuesta</title>
</head>
<body>

<h1><?php echo htmlspecialchars($encuesta['title']); ?></h1>
<p><?php echo htmlspecialchars($encuesta['description']); ?></p>

<form action="../backend/procesar_respuestas.php" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    
    <?php foreach ($encuesta['questions'] as $index => $question): ?>
        <h3><?php echo htmlspecialchars($question['text']); ?></h3>
        
        <?php if ($question['type'] === 'abierta'): ?>
            <input type="text" name="respuestas[<?php echo $index; ?>]" placeholder="Tu respuesta">
        
        <?php elseif ($question['type'] === 'multiple'): ?>
            <?php foreach ($question['options'] as $option): ?>
                <label>
                    <input type="radio" name="respuestas[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option); ?>">
                    <?php echo htmlspecialchars($option); ?>
                </label><br>
            <?php endforeach; ?>
        
        <?php elseif ($question['type'] === 'seleccion'): ?>
            <?php foreach ($question['options'] as $option): ?>
                <label>
                    <input type="checkbox" name="respuestas[<?php echo $index; ?>][]" value="<?php echo htmlspecialchars($option); ?>">
                    <?php echo htmlspecialchars($option); ?>
                </label><br>
            <?php endforeach; ?>
        
        <?php endif; ?>
    <?php endforeach; ?>

    <button type="submit">Enviar Respuestas</button>
</form>

</body>
</html>
