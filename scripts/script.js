function validar() {

    const usuario = document.getElementById('user').value;
    const contra = document.getElementById('password').value;

    if (usuario == 'victormgc' && contra == '12345678') {
        alert("Datos agregados correctamente");
        window.location.href = "generador.html";
        return;
    }
    else {
        alert("Usuario o contraseña incorrectos");
        return;
    }
    
}




const baseURL = "http://localhost/Projects/backend/api.php"

 // Crear un nuevo usuario
 document.getElementById('user-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const pass = document.getElementById('pass').value;

    fetch(baseURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name: name, pass: pass }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        //loadUsers();
        alert("Datos agregados correctamente");
    });
});



