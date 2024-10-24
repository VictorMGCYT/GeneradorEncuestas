<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Ejemplo: localhost
$username = "root";   // Ejemplo: root
$password = "12345678";  // Ejemplo: 
$dbname = "encuesta_bd"; // Ejemplo: my_database

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

//echo "Conexión exitosa"; // Puedes usar esto para verificar la conexión
?>