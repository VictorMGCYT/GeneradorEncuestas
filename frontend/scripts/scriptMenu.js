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

    // Escucha el botón de Formularios para cargar las encuestas dinámicamente
    document.getElementById('btnForm').addEventListener('click', function () {
        sliderBar.classList.toggle("active");
        menuToggle.classList.toggle("active");

        let padre = document.getElementById('contenido');
        let ultimosHijos = padre.getElementsByClassName('presentacion');

        // Eliminar el último elemento con la clase 'presentacion' si existe
        if (ultimosHijos.length > 0) {
            padre.removeChild(ultimosHijos[ultimosHijos.length - 1]);
        }

        let existe = padre.getElementsByClassName('agregarEncuesta');
        if (existe.length > 0) {
            padre.removeChild(existe[existe.length - 1]);
        }

        // Se encarga de generar el botón de agregar encuestas
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

        // Petición AJAX para obtener las encuestas del usuario
        fetch('../backend/recuperarEncuestas.php')
        .then(response => response.json())
        .then(encuestas => {
            if (encuestas.error) {
                console.error(encuestas.error);
                return;
            }

            // Generar dinámicamente las encuestas
            encuestas.forEach(encuesta => {
                let encuestaDiv = document.createElement('div');
                encuestaDiv.classList.add('noEncuestas');
                encuestaDiv.id = `encuesta-${encuesta.id}`;
                encuestaDiv.innerHTML = `
                    <h2>${encuesta.titulo}</h2>
                    <p>${encuesta.descripcion}</p>
                    <p class="token">Token: ${encuesta.token}</p>
                `;
                padre.appendChild(encuestaDiv);
            });
        })
        .catch(error => console.error('Error al cargar encuestas:', error));
    });
});
