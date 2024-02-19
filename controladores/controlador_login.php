<?php
require '../modelo.php'; // Incluir el archivo del modelo

session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    // Usuario autenticado, redirigir al controlador de arte
    header('Location: controlador_arte.php');
    exit();
}

// Inicializar variables de error
$error_message = '';
$username_error = '';
$password_error = '';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar campos
    if (empty($username)) {
        $username_error = 'El nombre de usuario es requerido';
    }
    if (empty($password)) {
        $password_error = 'La contraseña es requerida';
    }

    // Verificar las credenciales si no hay errores en los campos
    if (empty($username_error) && empty($password_error)) {
        // Verificar las credenciales en el modelo
        $usuario_autenticado = Modelo::verificarCredenciales($username, $password);

        if ($usuario_autenticado) {
            // Credenciales válidas, iniciar sesión y redirigir al controlador de arte
            $_SESSION['user_id'] = $usuario_autenticado['user_id'];
            $_SESSION['nombre_usuario'] = $usuario_autenticado['nombre_usuario']; // Almacenar el nombre de usuario en la sesión
            header('Location: controlador_arte.php');
            exit();
        } else {
            // Credenciales inválidas, mostrar un mensaje de error
            $error_message = "Credenciales inválidas. Por favor, inténtalo de nuevo.";
        }
    }
}

// Mostrar la vista de inicio de sesión
require '../views/login_form.blade.php';
?>
