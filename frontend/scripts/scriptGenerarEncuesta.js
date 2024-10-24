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