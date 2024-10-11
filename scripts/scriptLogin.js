const baseURL = "http://localhost/Projects/backend/login.php";

// Manejar el evento de inicio de sesión
document.getElementById('user-login').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const pass = document.getElementById('pass').value;

    // Validar que los campos no estén vacíos
    if (name && pass) {
        fetch(baseURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: name, pass: pass }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'User logged') {
                console.log('Inicio de sesión exitoso');
                window.location.href = "generador.html"; // Redirigir al inicio si el login es exitoso
            } else {
                console.error('Credenciales inválidas');
                alert('Usuario o contraseña incorrectos');
            }
        })
        .catch(error => {
            console.error('Error al iniciar sesión:', error);
            alert('Ocurrió un error. Inténtalo de nuevo.');
        });
    } else {
        alert('Por favor, completa todos los campos.');
    }
});
