document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById('menuToggle');
    const sliderBar = document.getElementById('sliderBar');

    menuToggle.addEventListener('click', function () {
        sliderBar.classList.toggle("active");
        menuToggle.classList.toggle("active");
    });

    document.getElementById("btnCerrar").addEventListener("click", function() {
        window.location.href = "../backend/logout.php";
    });

})

document.getElementById('btnForm').addEventListener('click', function () {
    sliderBar.classList.toggle("active");
    menuToggle.classList.toggle("active");

    let padre = document.getElementById('contenido');
    let ultimosHijos = padre.getElementsByClassName('presentacion');

    if (ultimosHijos.length > 0) {
        // Eliminar el último elemento con la clase 'presentacion'
        padre.removeChild(ultimosHijos[ultimosHijos.length - 1]); // Usar el último hijo
    }

    let existe = padre.getElementsByClassName('agregarEncuesta');

    if (existe.length > 0) {
        padre.removeChild(existe[existe.length - 1]);   
    }
    

    //Se encarga de generar el botón de agregar perguntas
    let hijoCrear;

    hijoCrear = document.createElement('div');
    hijoCrear.classList.add('agregarEncuesta');

    hijoCrear.innerHTML = `
        <span>+</span>
        <p>Crear nueva encuesta</p>
    `;

    padre.appendChild(hijoCrear);   
    
    //esta parte se encarga de recuperar la cantidad de encuestas
    //encontradas en la BD con el ID del usuario que ha ingresado
    // Petición AJAX para obtener las encuestas
    fetch('../backend/recuperarEncuestas.php')
    .then(response => response.json())
    .then(encuestas => {
        if (encuestas.error) {
            console.error(encuestas.error);
            return;
        }

        // Generar dinámicamente las encuestas
        encuestas.forEach((encuesta, index) => {
            console.log(encuesta);
            let noEncuestas = document.createElement('div');
            noEncuestas.classList.add('noEncuestas');
            noEncuestas.id = `encuesta-${encuesta.id}`;
            noEncuestas.innerHTML = `
                <h2>${encuesta.titulo}</h2>
                <p>${encuesta.descripcion}</p>
            `;
            padre.appendChild(noEncuestas);
        });
    })
    .catch(error => console.error('Error al cargar encuestas:', error));

});
