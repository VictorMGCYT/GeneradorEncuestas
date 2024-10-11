document.addEventListener('DOMContentLoaded', function() {

    let contador = fContador();
    
    
    //se encarga de refrescar el titulo superior de la pagina al ingresar nombre al form

    let tituloInput = document.getElementById('titulo');
    let tituloH1 = document.getElementById('updateTitulo');

    tituloInput.addEventListener('input' , function() {
        tituloH1.textContent = tituloInput.value;
        if (tituloH1.textContent == "") {
            tituloH1.textContent = 'Título';
        }
    })


    //se utiliza para hacer crecer el espacio asignado tanto para escribir una pregunta o descripcion del formulario

    const textArea = document.getElementById('subtitulo');

    textArea.addEventListener('input' , function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    })

    // sirve para hacer más grandes las preguntas
    let textArea2 = document.getElementsByClassName('agrandar');

    textArea2[0].addEventListener('input' , function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    })


    //Editar el tipo de pregunta y actualizar la sección

    // Obtenemos el select
    let inputOpcion = document.getElementById(`opciones-${contador}`);
    
    // Obtenemos el valor inicial del select al cargar la página
    let valueOpcion = inputOpcion.value;
    console.log('Valor inicial: ' + valueOpcion);

    // Escuchar cuando el usuario cambie la selección
    inputOpcion.addEventListener('change', function() {
        valueOpcion = inputOpcion.value;
        console.log('Value seleccionado: ' + valueOpcion);
        contador = fContador();
    });


    //Código para insertar el código dependiendo del tipo de pregunta seleccionado

    // ? Esta primera parte es para hacer que por defecto aparezca el html de opcion multiple

    let padre = document.getElementById('preguntas');

    let divHijo = document.createElement('div');

    divHijo.classList.add('tipoPregunta');


    divHijo.innerHTML = `
                <form>
                    <label>
                        <input class="styleRadio" type="radio" name="opcion1" value="opcion1" disabled>
                        <input class="radioStyle" type="text" placeholder="Escribe la opción">
                    </label><br>
                    <label>
                        <input class="styleRadio" type="radio" name="opcion2" value="opcion2" disabled>
                        <input class="radioStyle" type="text" placeholder="Escribe la opción">
                    </label><br>
                    <label>
                        <input class="styleRadio" type="radio" name="opcion3" value="opcion3" disabled>
                        <input class="radioStyle" type="text" placeholder="Escribe la opción">
                    </label><br>
                    <label>
                        <input class="styleRadio" type="radio" name="opcion4" value="opcion4" disabled>
                        <input class="radioStyle" type="text" placeholder="Escribe la opción">
                    </label><br>
                    <label>
                        <input class="styleRadio" type="radio" name="opcion5" value="opcion5" disabled>
                        <input class="radioStyle" type="text" placeholder="Escribe la opción">
                    </label>
                </form>
            `; 


    padre.appendChild(divHijo);

    // ? Esta segunda parte es para hacer que el html cambie con la selección
    

    document.getElementById(`opciones-${contador}`).addEventListener("change", function () {
        console.log(contador);
        let seleccion = this.value;
        let padre = document.getElementById('preguntas');

        // Eliminar el último div 'tipoPregunta' si existe
        let ultimoDivHijos = padre.getElementsByClassName('tipoPregunta');
        if (ultimoDivHijos.length > 0) {
            padre.removeChild(ultimoDivHijos[ultimoDivHijos.length - 1]);
        }

        // Solo crear un nuevo div si la opción seleccionada es 'Opcion_multiple'
        if (seleccion == 'Opcion_multiple') {
            let divHijo = document.createElement('div');
            divHijo.classList.add('tipoPregunta');

            divHijo.innerHTML = `<form>
                        <label>
                            <input class="styleRadio" type="radio" name="opcion1" value="opcion1" disabled>
                            <input class="radioStyle" type="text" placeholder="Escribe la opción">
                        </label><br>
                        <label>
                            <input class="styleRadio" type="radio" name="opcion2" value="opcion2" disabled>
                            <input class="radioStyle" type="text" placeholder="Escribe la opción">
                        </label><br>
                        <label>
                            <input class="styleRadio" type="radio" name="opcion3" value="opcion3" disabled>
                            <input class="radioStyle" type="text" placeholder="Escribe la opción">
                        </label><br>
                        <label>
                            <input class="styleRadio" type="radio" name="opcion4" value="opcion4" disabled>
                            <input class="radioStyle" type="text" placeholder="Escribe la opción">
                        </label><br>
                        <label>
                            <input class="styleRadio" type="radio" name="opcion5" value="opcion5" disabled>
                            <input class="radioStyle" type="text" placeholder="Escribe la opción">
                        </label>
                    </form>`;

            // Añadir el nuevo div al padre
            padre.appendChild(divHijo);
        }

        if (seleccion == 'Casilla_selección') {
            let divHijo = document.createElement('div');
            divHijo.classList.add('tipoPregunta');

            divHijo.innerHTML = `<form>
                            <label>
                                <input class="styleCheck" type="checkbox" name="color" value="opcion1" disabled>
                                <input class="radioStyle" type="text" placeholder="Escribe la opción">
                            </label><br>
                            <label>
                                <input class="styleCheck" type="checkbox" name="color" value="opcion2" disabled>
                                <input class="radioStyle" type="text" placeholder="Escribe la opción">
                            </label><br>
                            <label>
                                <input class="styleCheck" type="checkbox" name="color" value="opcion3" disabled>
                                <input class="radioStyle" type="text" placeholder="Escribe la opción">
                            </label><br>
                            <label>
                                <input class="styleCheck" type="checkbox" name="color" value="opcion4" disabled>
                                <input class="radioStyle" type="text" placeholder="Escribe la opción">
                            </label><br>
                            <label>
                                <input class="styleCheck" type="checkbox" name="color" value="opcion5" disabled>
                                <input class="radioStyle" type="text" placeholder="Escribe la opción">
                            </label>
                        </form>`;

            // Añadir el nuevo div al padre
            padre.appendChild(divHijo);
        }

        if (seleccion == 'Abierta') {
            let divHijo = document.createElement('div');
            divHijo.classList.add('tipoPregunta');

            divHijo.innerHTML = `
                            <textarea class="respAbierta" id="subtitulo" type="text" placeholder="Respuesta abierta"></textarea>
                            `;

            // Añadir el nuevo div al padre
            padre.appendChild(divHijo);
        }
    });
});