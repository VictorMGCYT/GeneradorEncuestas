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
    <script>
        let questionCount = 0;

        function addQuestion() {
            questionCount++;
            
            const questionDiv = document.createElement("div");
            questionDiv.className = "question";
            questionDiv.id = `question_${questionCount}`;

            questionDiv.innerHTML = `
                <label for="question_${questionCount}_text">Pregunta ${questionCount}:</label>
                <input type="text" name="questions[${questionCount}][text]" id="question_${questionCount}_text" required><br>

                <label for="question_${questionCount}_type">Tipo de Pregunta:</label>
                <select name="questions[${questionCount}][type]" id="question_${questionCount}_type" onchange="updateQuestionType(${questionCount})">
                    <option value="abierta">Abierta</option>
                    <option value="multiple">Opción Múltiple</option>
                    <option value="seleccion">Casilla de Selección</option>
                </select><br>

                <div id="question_${questionCount}_options" class="options"></div>
            `;

            document.getElementById("questions").appendChild(questionDiv);
        }

        function updateQuestionType(questionId) {
            const typeSelect = document.getElementById(`question_${questionId}_type`);
            const optionsDiv = document.getElementById(`question_${questionId}_options`);

            optionsDiv.innerHTML = ""; // Limpiar las opciones anteriores

            if (typeSelect.value === "multiple" || typeSelect.value === "seleccion") {
                for (let i = 1; i <= 5; i++) {
                    optionsDiv.innerHTML += `
                        <label for="question_${questionId}_option_${i}">Opción ${i}:</label>
                        <input type="text" name="questions[${questionId}][options][${i}]" id="question_${questionId}_option_${i}" required><br>
                    `;
                }
            }
        }

        function saveSurvey() {
            document.getElementById("surveyForm").submit();
        }
    </script>
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

</body>
</html>
