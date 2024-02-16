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
    // Si no está autenticado, redirigir al archivo de inicio de sesión
    header('Location: controladores/controlador_login.php');
    exit();
}

// Obtener el ID del usuario que ha iniciado sesión
$user_id = $_SESSION['user_id'];

// Obtener el nombre del usuario
$username = Modelo::obtenerNombreUsuario($user_id);

// Verificar si se obtuvo el nombre del usuario correctamente
if (!$username) {
    // Si no se pudo obtener el nombre del usuario, redirigir al controlador de inicio de sesión
    header('Location: controlador_login.php');
    exit();
}

// Renderizar la vista del navbar
echo $blade->run("bootstrapNav_form", ["username" => $username]);
echo $blade->run("cupcakes", ["username" => $username]);
?>