let questionCount = 0;

function addQuestion() {
    questionCount++;
    
    const questionDiv = document.createElement("div");
    questionDiv.className = "question";
    questionDiv.id = `question_${questionCount}`;

    questionDiv.innerHTML = `
        <div class="pregunta">
        <label for="question_${questionCount}_text">Pregunta ${questionCount}:</label>
        <input placeholder="Ingresa tu pregunta" type="text" name="questions[${questionCount}][text]" id="question_${questionCount}_text" required><br>
        </div>

        <div class="tipoPregunta">
        <label for="question_${questionCount}_type">Tipo de Pregunta:</label>
        <select name="questions[${questionCount}][type]" id="question_${questionCount}_type" onchange="updateQuestionType(${questionCount})">
            <option value="abierta">Abierta</option>
            <option value="multiple">Opción Múltiple</option>
            <option value="seleccion">Casilla de Selección</option>
        </select><br>
        </div>

        <div id="question_${questionCount}_options" class="options">
        </div>
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
                <input class="inOpcion" type="text" name="questions[${questionId}][options][${i}]" id="question_${questionId}_option_${i}" placeholder="Opción ${i}" ><br>
            `;
        }
    }
}

function validateSurvey() {
    const title = document.getElementById("surveyTitle").value.trim();
    const description = document.getElementById("surveyDescription").value.trim();
    
    // Verificar si el título y la descripción están vacíos
    if (!title || !description) {
        alert("Por favor, completa el título y la descripción.");
        return false;
    }

    // Verificar que al menos haya una pregunta
    if (questionCount < 1) {
        alert("Debes agregar al menos una pregunta.");
        return false;
    }

    // Verificar cada pregunta
    const questions = document.querySelectorAll(".question");
    for (let question of questions) {
        const questionText = question.querySelector(`input[name^="questions"][name*="[text]"]`).value.trim();
        const options = question.querySelectorAll(".inOpcion");
        const typeSelect = question.querySelector(`select[name^="questions"][name*="[type]"]`).value;

        // Validar que el texto de la pregunta no esté vacío
        if (!questionText) {
            alert("La pregunta no puede estar vacía.");
            return false;
        }

        // Si la pregunta es de tipo "multiple" o "seleccion", validar opciones
        if (typeSelect === "multiple" || typeSelect === "seleccion") {
            let atLeastOneFilled = false; // Para verificar al menos una opción llena
            options.forEach(option => {
                const optionValue = option.value.trim();
                if (optionValue !== "") {
                    atLeastOneFilled = true;
                }
            });

            if (!atLeastOneFilled) {
                alert("Debes completar al menos una opción para la pregunta " + question.querySelector(`label`).innerText);
                return false;
            }
        }
    }

    return true; // Todo está correcto
}

function saveSurvey() {
    if (validateSurvey()) {
        document.getElementById("surveyForm").submit();
    }
}
