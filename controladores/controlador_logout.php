<?php
require_once '../modelo.php';

// Cerrar la sesión
Modelo::cerrarSesion();

// Redirigir a la página de inicio de sesión
header('Location: controlador_login.php');
exit();
?>
