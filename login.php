<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

session_start();

// Inicializar $error_message
$error_message = null;

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    // Usuario autenticado, redirigir al archivo con la plantilla de cupcakes
    header('Location: arte.php');
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar las credenciales
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar las credenciales en la base de datos
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "usermgmt";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar la base de datos para verificar las credenciales
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE name = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();

        if (count($result) == 1) {
            $hashed_password = $result[0]['password'];

            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            if ($password === $hashed_password) {
                // Credenciales válidas, iniciar sesión y redirigir al archivo con la plantilla de cupcakes
                $_SESSION['user_id'] = $result[0]['id'];
                $_SESSION['nombre_usuario'] = $result[0]['name']; // Almacenar el nombre de usuario en la sesión
                header('Location: arte.php');
                exit();
            }
        }

        // Credenciales inválidas, mostrar un mensaje de error
        $error_message = "Credenciales inválidas. Por favor, inténtalo de nuevo.";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Renderizar el formulario de inicio de sesión
echo $blade->run("login_form", ["error_message" => $error_message]);
?>
