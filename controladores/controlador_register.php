<?php
require '../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

require '../modelo.php'; // Incluir el archivo del modelo

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrarse'])) {
        // Obtener los datos del formulario
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $painter_fk = $_POST['painter']; // Cambiado de 'painter' a 'painter_fk'

        // Registrar el usuario en la base de datos
        if (Modelo::registrarUsuario($name, $email, $password, $painter_fk)) {
            // Redirigir a la página de inicio de sesión si el registro fue exitoso
            header('Location: controlador_login.php');
            exit();
        } else {
            // Mostrar mensaje de error si hubo un problema durante el registro
            echo "Error al registrarse.";
        }
    } elseif (isset($_POST['volverInicio'])) {
        // Redirigir al controlador de inicio de sesión si se presionó el botón "Volver al inicio"
        header('Location: controlador_login.php');
        exit();
    }
}

// Obtener la lista de pintores desde el modelo
$painters = Modelo::obtenerPintores();

// Renderizar el formulario de registro con la lista de pintores
echo $blade->run("register", ["painters" => $painters]);
?>
