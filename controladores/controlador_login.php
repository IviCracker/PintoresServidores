<?php
require '../modelo.php'; // Incluir el archivo del modelo

session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    // Usuario autenticado, redirigir al controlador de arte
    header('Location: controlador_arte.php');
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar las credenciales
    $username = $_POST['username'];
    $password = $_POST['password'];

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
        require '../views/login_form.blade.php'; // Mostrar vista de inicio de sesión con mensaje de error
        exit();
    }
}

// Mostrar la vista de inicio de sesión
require '../views/login_form.blade.php';
?>
