<?php
require '../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
require '../modelo.php'; // Incluir el archivo del modelo

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al controlador de inicio de sesión
    header('Location: controlador_login.php');
    exit();
}


// Obtener el ID del usuario que ha iniciado sesión
$user_id = $_SESSION['user_id'];



// Obtener el nombre del usuario
$nombre_usuario = Modelo::obtenerNombreUsuario($user_id);

// Verificar si se obtuvo el nombre del usuario correctamente
if (!$nombre_usuario) {
    // Si no se pudo obtener el nombre del usuario, redirigir al controlador de inicio de sesión
    header('Location: controlador_login.php');
    exit();
}

// Obtener los cupcakes asociados al usuario
$cupcakes = Modelo::obtenerCupcakesUsuario($user_id);

// Verificar si se obtuvieron los cupcakes correctamente
if (!$cupcakes) {
    // Si no se pudieron obtener los cupcakes, mostrar un mensaje de error
    $error_message = "No se pudieron obtener los cupcakes asociados al usuario.";
    // Aquí podrías redirigir a una vista de error o mostrar el mensaje en la misma página
    exit();
}
echo $blade->run("bootstrapNav_form", ["nombre_usuario" => $nombre_usuario]);

// Mostrar la vista de cupcakes
require '../views/cupcakes.blade.php';
?>