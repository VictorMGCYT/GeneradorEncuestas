document.addEventListener('DOMContentLoaded', function() {
    let padre = document.getElementById('test');

    let divHijo = document.createElement('div');

    divHijo.classList.add('preguntas');
    divHijo.id = 'preguntas';


    divHijo.innerHTML = `     
                <div id="pregunta-1" class="textoPregunta">
                    <textarea class="inputPregunta agrandar" type="text" placeholder="Pregunta-1"></textarea>
                </div>
                <div class="controles">
                    <select class="opciones" id="opciones-1">
                        <option value="Opcion_multiple">Opcion multiple</option>
                        <option value="Abierta">Abierta</option>
                        <option value="Casilla_selección">Casilla de selección</option>
                    </select>
                </div>

            `; 


    padre.appendChild(divHijo);


});

    let contador = 1;

    function fContador() {
    return contador;
    }

    function generarPregunta() {
        contador++;
        fContador();
        console.log('Generar pregunta contador: ' + contador);
        

        let padre = document.getElementById('preguntas');



        padre.innerHTML += `    
                    <hr>
                    <div id="pregunta-${contador}" class="textoPregunta">
                        <textarea class="inputPregunta agrandar" type="text" placeholder="Pregunta-${contador}"></textarea>
                    </div>
                    <div class="controles">
                        <select class="opciones" id="opciones-${contador}">
                            <option value="Opcion_multiple">Opcion multiple</option>
                            <option value="Abierta">Abierta</option>
                            <option value="Casilla_selección">Casilla de selección</option>
                        </select>
                    </div>

                `; 


    }