<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

// Configuración de la conexión a la base de datos
$dsn = "mysql:host=localhost;dbname=usermgmt";
$username = "root";
$password = "";

try {
    // Intentar establecer la conexión PDO
    $pdo = new PDO($dsn, $username, $password);
    // Configurar el modo de errores de PDO para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejo de errores de la conexión a la base de datos
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Verificar si se envió un formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar los datos del formulario de registro
    // Verificar si los campos obligatorios no están vacíos
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['painter'])) {
        die("Por favor, completa todos los campos obligatorios.");
    }

    // Procesar los datos del formulario de registro
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // No se usa password_hash()
    $painter_fk = $_POST['painter'];

    try {
        // Preparar la consulta SQL para insertar un nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO users (name, password, email, painter_fk) VALUES (?, ?, ?, ?)");

        // Verificar si la consulta SQL es válida
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $pdo->errorInfo()[2]);
        }

        // Ejecutar la consulta
        $stmt->execute([$name, $password, $email, $painter_fk]);

        // Mostrar mensaje de registro exitoso
        echo "Registro exitoso";

        // Cerrar la consulta
        $stmt->closeCursor();
    } catch (PDOException $e) {
        // Mostrar mensaje de error al registrar el usuario
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}

// Obtener la lista de pintores desde la base de datos
try {
    $stmt = $pdo->query("SELECT id, name FROM painters");

    // Obtener los pintores
    $painters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar errores al obtener la lista de pintores
    die("Error al obtener la lista de pintores: " . $e->getMessage());
}

// Renderizar el formulario de registro con la lista de pintores
echo $blade->run("register", ["painters" => $painters]);
?>
