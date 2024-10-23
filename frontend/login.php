
<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION["usuario"])) {
    header("Location: ../frontend/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

            <div class="input-group">
                <form id="user-login" action="../backend/login.php" method="post">
                <label for="user">Usuario</label>
                <input required
                    maxlength="10"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Ingresa usuario"
                />
                <label for="password">Contraseña</label>
                <input required
                    maxlength="8"
                    type="password"
                    id="pass"
                    name="pass"
                    placeholder="Ingresa tu contraseña"
                />
                <button type="submit">Ingresar</button>
                </form>
                <br>
                <a href="register.php">Eres nuevo, crea una cuenta aqui</a>
            </div>
        </div>
    </div>


</body>
</html>