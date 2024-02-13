<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al archivo de inicio de sesión
    header('Location: login.php');
    exit();
}

// Obtener el ID del usuario que ha iniciado sesión
$user_id = $_SESSION['user_id'];

// Configuración de la base de datos
$dsn = "mysql:host=localhost;dbname=usermgmt";
$username_db = "root";
$password_db = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Conexión a la base de datos
    $conn = new PDO($dsn, $username_db, $password_db, $options);

    // Obtener el nombre del usuario
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $username = $stmt->fetchColumn();

    echo "Nombre de usuario: " . $username;

    // Cerrar la conexión a la base de datos
    $conn = null;

    echo $blade->run("bootstrapNav_form", ["username" => $username]);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
