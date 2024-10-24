<?php
session_start(); // Iniciar la sesión


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../frontend/login.php");
    exit();
}

if(isset($_GET['token'])){
    $validToken = $_GET['token'];
    $tokenLen = strlen($validToken);
    if($tokenLen > 50 || $tokenLen < 50){
        echo '<script>alert("EL TOKEN ES DE 50. \n Tú tienes: '.$tokenLen.'"); </script>';
    }else{
        $_SESSION["token"] = $_GET['token'];
    }
}else{
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Encuestas</title>
    <link rel="stylesheet" href="../css/styleGenerador.css">
</head>
<body>

    <section id="bar">
        <div class="menu small-menu">
            <a href="../index.php">
                <img class="icon-size" src="../iconos/form.svg" alt="">
                <span style="">&nbsp;Inicio</span>
            </a>
        </div>
        <div class="menu medium-menu">
            <h1 id="updateTitulo">
                Generador de Encuesta
            </h1>
        </div>
        <div class="right">
            <div class="menu small-menu">
                <button>
                <img class="icon-size2" src="../iconos/eye.svg" alt="">
                <span class="tooltip">Vista previa</span>
                </button>
            </div>
            <div class="menu small-menu">
                <button>
                <img class="icon-size2" src="../iconos/options.svg" alt="">
                <span class="tooltip">Opciones</span>
                </button>
            </div>
        </div>
    </section>


    <section class="sec2">
        <form id="surveyForm" action="../../backend/resultado.php" method="POST">
            <div class="encabezado">
                <input placeholder="Título" type="text" name="surveyTitle" id="surveyTitle" class="surveyTitle" required><br><br>
                <textarea placeholder="Descripción" name="surveyDescription" id="surveyDescription" class="surveyDescription" required></textarea><br><br>
            </div>
        

            <div class="questions" id="questions">

                <h3>Preguntas:</h3>

            </div>

            <div class="btnAdd">
                <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br>
                <button type="button" onclick="saveSurvey()">Guardar Encuesta</button>
            </div>

        </form>
    </section>



<script src="../scripts/scriptGenerarEncuesta.js"></script>


</body>
</html>
