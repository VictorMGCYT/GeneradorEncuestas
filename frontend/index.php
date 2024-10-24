<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

if (isset($_GET["valor"])) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $token = '';
    for ($i = 0; $i < 50; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    echo "Tu token es: " . $token;
    header("Location: /GeneradorEncuestas/frontend/generador2.php/?token=" . $token);
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="css/stylemenu.css">
</head>

<body>
    <section class="menu-container">
        <div class="leftbar" id="sliderBar">
            <img src="iconos/user-icon.svg" alt="">
            <h2><?php echo htmlspecialchars($_SESSION["usuario"]); ?></h2>
            <hr>
            <div class="formularios">
                <button class="btnForm" id="btnForm">Formularios</button>
            </div>
            <div class="resultados">
                <button class="btnResult" id="btnResult">Resultados</button>
            </div>
            <div class="cerrar">
                <button class="btnCerrar" id="btnCerrar">Cerrar sesión</button>
            </div>
        </div>
        <div class="desplegable">
            <button id="menuToggle">☰</button>
        </div>

        <div class="contenido" id="contenido">
            <form action="" method="get">
                <input type="submit" name="valor">
            </form>
            <div class="presentacion">
                <img src="imagenes/logo-pagina.jpg" alt="">
                <h1>Bienvenido al generador de formularios</h1>
                <p>
                    Crea formularios personalizados de manera rápida y sencilla. Con nuestra
                    herramienta intuitiva, puedes diseñar formularios que se adapten a tus
                    necesidades, sin complicaciones. ¡Comienza a construir tus formularios
                    hoy mismo!
                </p>
            </div>

        </div>
    </section>

    <script src="scripts/scriptMenu.js"></script>
</body>

</html>