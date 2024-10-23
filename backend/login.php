<?php
// Conecta a la base de datos
//$conn = mysqli_connect("localhost", "root", "12345678", "crud_db");
include './config/conn.php';

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verifica que se hayan enviado los datos del formulario
if (isset($_POST["name"]) && isset($_POST["pass"])) {
    $usuario = $_POST["name"];
    $contraseña = $_POST["pass"];

    // Usar sentencia preparada para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, pass FROM users WHERE name = ?"); // Selecciona el ID junto con la contraseña
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash_almacenado = $row['pass'];

        // Verificar la contraseña ingresada con el hash almacenado
        if (password_verify($contraseña, $hash_almacenado)) {
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["usuario_id"] = $row['id']; // Almacena el ID del usuario

            header("Location: ../frontend/index.php");
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos!'); window.location.href = '../frontend/login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos!'); window.location.href = '../frontend/login.php';</script>";
    }
    $stmt->close();
}
$conn->close();
?>
