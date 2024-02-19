<?php
require '../Modelo.php';
require '../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use eftec\bladeone\BladeOne;

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al controlador de inicio de sesión
    header('Location: controlador_login.php');
    exit();
}

// Obtener el ID del usuario que ha iniciado sesión
$user_id = $_SESSION['user_id'];

// Obtener los datos del usuario para prellenar el formulario
$name = Modelo::obtenerNombreUsuario($user_id);
$contraseña = Modelo::obtenerContraseñaUsuario($user_id);
$email = Modelo::obtenerEmailUsuario($user_id);

// Si no se pudo obtener el nombre del usuario, mostrar un mensaje de error
if (!$name) {
    echo "Error: No se pudo obtener la información del usuario.";
    exit();
}

// Obtener la lista de pintores para la selección
$pintores = Modelo::obtenerPintores();

if (!$pintores) {
    // Manejar el error si no se pueden obtener los pintores
    exit();
}

// Variables para controlar el resaltado de errores
$error_username = '';
$error_email = '';
$error_password = '';

// Instanciar BladeOne
$views = __DIR__ . '/../views'; // Ruta al directorio de vistas
$cache = __DIR__ . '/../cache'; // Ruta al directorio de caché
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

// Verificar si se está enviando un formulario de actualización o eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar_cambios'])) {
        // Obtener los datos del formulario
        $new_name = $_POST['username'];
        $new_email = $_POST['email'];
        $password = $_POST['password'];
        $painter_fk = $_POST['painter'];

        // Validar la contraseña
        if (!Modelo::validarContraseña($password)) {
            $error_password = 'La contraseña debe tener al menos 4 caracteres, una mayúscula, una minúscula y un carácter especial';
        }

        // Validar si ya existe un usuario con el nuevo nombre
        if ($new_name !== $name && Modelo::existeNombreUsuario($new_name, $user_id)) {
            $error_username = 'Este nombre de usuario ya está en uso';
        }

        // Validar si ya existe un usuario con el nuevo correo electrónico
        if ($new_email !== $email && Modelo::existeCorreoUsuario($new_email, $user_id)) {
            $error_email = 'Este correo ya está en uso';
        }

        // Si hay errores, no redireccionar
        if ($error_username !== '' || $error_email !== '' || $error_password !== '') {
            // Mostrar la vista de modificarUsuario con los errores
            echo $blade->run("bootstrapNav_form", ["nombre_usuario" => $name]);
            echo $blade->run("modificarUsuario_form", ["name" => $name,"contraseña" => $contraseña, "email" => $email, "pintores" => $pintores, "error_username" => $error_username, "error_email" => $error_email, "error_password" => $error_password]);
            exit(); // Detener la ejecución del script
        }

        // Actualizar los datos del usuario en la base de datos
        if (Modelo::actualizarUsuario($user_id, $new_name, $new_email, $password, $painter_fk)) {
            // Redirigir a la página de arte si la actualización fue exitosa
            header('Location: controlador_arte.php');
            exit();
        } else {
            echo "Error al actualizar los datos del usuario.";
        }
    } elseif (isset($_POST['eliminar_cuenta'])) {
        // Lógica para eliminar cuenta
        if (Modelo::eliminarUsuario($user_id)) {
            // Si la eliminación fue exitosa, redirigir al controlador de inicio de sesión
            header('Location: controlador_logout.php');
            exit();
        } else {
            // Si hubo un error al eliminar la cuenta, mostrar un mensaje de error
            echo "Error al eliminar la cuenta.";
        }
    }
}

// Mostrar la vista de modificarUsuario
echo $blade->run("bootstrapNav_form", ["nombre_usuario" => $name]);
echo $blade->run("modificarUsuario_form", ["name" => $name,"contraseña" => $contraseña, "email" => $email, "pintores" => $pintores, "error_username" => $error_username, "error_email" => $error_email, "error_password" => $error_password]);
?>
