<?php
require '../vendor/autoload.php';
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

require '../modelo.php';
session_start();

$error_username = '';
$error_email = '';
$error_password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrarse'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $painter_fk = $_POST['painter'];

        if (Modelo::existeNombreUsuario($username)) {
            $error_username = 'Este nombre de usuario ya está en uso';
        }

        if (Modelo::existeCorreoUsuario($email)) {
            $error_email = 'Este correo ya está en uso';
        }

        if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){5,}$/', $contraseña)) {
            $error_password = 'La contraseña debe tener al menos 5 caracteres, 1 mayúscula, 1 minúscula y un carácter especial';
        }

        if ($error_username === '' && $error_email === '' && $error_password === '') {
            if (Modelo::registrarUsuario($username, $email, $contraseña, $painter_fk)) {
                header('Location: controlador_arte.php');
                exit();
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
}

$painters = Modelo::obtenerPintores();

echo $blade->run("register", [
    "painters" => $painters,
    "error_username" => $error_username,
    "error_email" => $error_email,
    "error_password" => $error_password
]);
?>