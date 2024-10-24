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

    // Evento para abrir view.php con el token al hacer clic en una card
    document.addEventListener("click", function(event) {
        if (event.target.closest(".noEncuestas")) {
            const token = event.target.closest(".noEncuestas").dataset.token;
            window.location.href = `view.php?token=${token}`;
        }
    });
});

document.getElementById('btnForm').addEventListener('click', function () {
    sliderBar.classList.toggle("active");
    menuToggle.classList.toggle("active");

    let padre = document.getElementById('contenido');
    let ultimosHijos = padre.getElementsByClassName('presentacion');

    if (ultimosHijos.length > 0) {
        padre.removeChild(ultimosHijos[ultimosHijos.length - 1]);
    }

    let existe = padre.getElementsByClassName('agregarEncuesta');

    if (existe.length > 0) {
        padre.removeChild(existe[existe.length - 1]);   
    }
    
    let hijoCrear = document.createElement('form');
    hijoCrear.classList.add('agregarEncuesta');
    hijoCrear.method = 'GET';
    hijoCrear.innerHTML = `
        <button class="anchoBtn" type="submit" name="valor">
            <span>+</span>
            <p>Crear nueva encuesta</p>
        </button>
    `;
    padre.appendChild(hijoCrear);   
    
    // Petición AJAX para obtener las encuestas
    fetch('../backend/recuperarEncuestas.php')
    .then(response => response.json())
    .then(encuestas => {
        if (encuestas.error) {
            console.error(encuestas.error);
            return;
        }

        encuestas.forEach((encuesta) => {
            let noEncuestas = document.createElement('div');
            noEncuestas.classList.add('noEncuestas');
            noEncuestas.id = `encuesta-${encuesta.id}`;
            noEncuestas.dataset.token = encuesta.token; // Asignar el token de la encuesta
            noEncuestas.innerHTML = `
                <h2>${encuesta.titulo}</h2>
                <p>${encuesta.descripcion}</p>
            `;
            padre.appendChild(noEncuestas);
        });
    })
    .catch(error => console.error('Error al cargar encuestas:', error));
});
