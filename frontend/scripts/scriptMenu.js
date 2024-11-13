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
                <button name="${encuesta.id}" id="delete${encuesta.id}" class="deleteEncuesta">
                <svg style="filter: invert(100%);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
                <h2>${encuesta.titulo}</h2>
                <p>${encuesta.descripcion}</p>
            `;
            padre.appendChild(noEncuestas);
        });
    })
    .catch(error => console.error('Error al cargar encuestas:', error));
});



document.getElementById('contenido').addEventListener('click', function (event) {
    if (event.target.closest('.deleteEncuesta')) {
        event.stopPropagation();
        const clickedButton = event.target.closest('.deleteEncuesta');
        const encuestaId = clickedButton.name; // ID de la encuesta
    
        // Confirmar antes de eliminar
        if (confirm(`¿Estás seguro de que deseas eliminar la encuesta ${encuestaId}?`)) {
            // Enviar petición para eliminar la encuesta
            fetch('../backend/borrarEncuesta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${encuestaId}`, // Enviar el ID
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                alert(data.success);
                // Opcional: Remover el div del DOM
                const divEncuesta = document.getElementById(`encuesta-${encuestaId}`);
                if (divEncuesta) divEncuesta.remove();
                } else {
                alert(data.error);
                }
            })
            .catch((error) => console.error('Error:', error));
        }
    }
  });
  

