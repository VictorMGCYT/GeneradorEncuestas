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
    <style>
        .question {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<h2>Generador de Encuestas</h2>

<form id="surveyForm" action="../../backend/resultado.php" method="POST">
    <label for="surveyTitle">Título de la Encuesta:</label>
    <input type="text" name="surveyTitle" id="surveyTitle" required><br><br>

    <label for="surveyDescription">Descripción de la Encuesta:</label>
    <textarea name="surveyDescription" id="surveyDescription" required></textarea><br><br>

    <h3>Preguntas:</h3>
    <div id="questions"></div>

    <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br><br>

    <button type="button" onclick="saveSurvey()">Guardar Encuesta</button>
</form>


<script src="../scripts/scriptGenerarEncuesta.js"></script>


</body>
</html>
