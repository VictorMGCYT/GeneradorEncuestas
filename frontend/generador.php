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
        echo '<script>alert("NO SEAS PENDEJO. EL TOKEN ES DE 50, NO MENOS. PERRA!!! \n Tú tienes: '.$tokenLen.' NO CAMBIES LA PUTA URL"); </script>';
    }else{
    }
}else{
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar encuesta</title>
    <link rel="stylesheet" href="../css/estilosgenerador.css">
</head>
<body>
    <section id="bar">
        <div class="menu small-menu">
        <a href="../index.php">
            <img class="icon-size" src="../iconos/form.svg" alt="">
            <span class="tooltip">Inicio</span>
            </a>
        </div>
        <div class="menu medium-menu">
            <h1 id="updateTitulo">
                <?php
                echo $_GET['token'];
                ?>
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

    <div id="container">
        <section id="header">
            <div class="encabezado">
                <input class="txtTitulo" id="titulo" type="text" placeholder="Título">
                <textarea class="txtSubti" id="subtitulo" type="text" placeholder="Descripción"></textarea>
            </div>
        </section>
    
        <section id="test">
                    
        </section>
        

        <section id="aumentar">
            <div class="agregarPregunta">
                <button onclick="generarPregunta()" type="button">Agregar nueva pregunta</button>
            </div> 
            
        </section>
    </div>
    
    <script src="../scripts/generarpreguntas.js"></script>
    <script src="../scripts/scriptencuestas.js"></script>
</body>
</html>