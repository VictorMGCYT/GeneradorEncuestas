<?php

// Destruir la sesión y eliminar todas las variables de sesión
session_unset(); 
session_destroy(); 

// Redirigir al usuario a la página de inicio de sesión o a la página que desees
header("Location: ../frontend/login.html");
exit();
?>