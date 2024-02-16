<?php
require '../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

require '../modelo.php'; // Incluir el archivo del modelo
echo "Error al actualizar los datos del usuario1";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Error al actualizar los datos del usuario2";

    if (isset($_POST['registrarse'])) {
        echo "Error al actualizar los datos del usuario3";

        // Obtener los datos del formulario
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $painter_fk = $_POST['painter']; // Cambiado de 'painter' a 'painter_fk'

        // Actualizar los datos del usuario en la base de datos
        if (Modelo::registrarUsuario($username, $email, $contraseña, $painter_fk)) {
            // Redirigir a la página de arte si la actualización fue exitosa
            header('Location: controlador_arte.php');
            exit();
        } else {
            echo "Error al actualizar los datos del usuario.";
        }
    }
}else{
    echo "Error al actualizar aaaaa.";

}

// Obtener la lista de pintores desde el modelo
$painters = Modelo::obtenerPintores();

// Renderizar el formulario de registro con la lista de pintores
echo $blade->run("register", ["painters" => $painters]);
?>
