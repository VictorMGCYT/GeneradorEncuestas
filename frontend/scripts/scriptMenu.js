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


    document.getElementById('btnForm').addEventListener('click', function () {
        sliderBar.classList.toggle("active");
        menuToggle.classList.toggle("active");
    
        let padre = document.getElementById('contenido');
        let hijos = padre.getElementsByClassName('presentacion');
    
        if (hijos.length > 0) {
            // Eliminar el último elemento con la clase 'presentacion'
            padre.removeChild(hijos[hijos.length - 1]); // Usar el último hijo
        }
    });
    
})

