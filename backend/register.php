<?php
// Conecta a la base de datos
//$conn = mysqli_connect("localhost", "root", "12345678", "cru_db");
include './config/conn.php';

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verifica que se hayan enviado los datos del formulario
if (isset($_POST["name"]) && isset($_POST["pass"])) {
    $usuario = $_POST["name"];
    $contraseña = $_POST["pass"];

    // Usar sentencia preparada para evitar SQL Injection
    // Primero, verifica si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El usuario ya existe
        echo "<script>alert('El nombre de usuario ya existe. Por favor, elige otro.'); window.history.back();</script>";
    } else {
        // El usuario no existe, se puede insertar
        $stmt->close(); // Cierra la consulta anterior

        // Hashear la contraseña
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

        // Preparar la inserción
        $stmt = $conn->prepare("INSERT INTO users (name, pass) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $contraseña_hash);
        if ($stmt->execute()) {
            // Inserción exitosa
            echo "<script>alert('Usuario registrado exitosamente.'); window.location.href = '../frontend/login.php';</script>";
        } else {
            // Error al insertar
            echo "<script>alert('Error al registrar el usuario.'); window.history.back();</script>";
        }
    }

    $stmt->close(); // Cierra la consulta de inserción
}
$conn->close();
?>
