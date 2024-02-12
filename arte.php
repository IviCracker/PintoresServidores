<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

session_start();
echo $blade->run("bootstrapNav_form");
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

    // Realizar una consulta SQL para obtener el pintor favorito del usuario
    $stmt = $conn->prepare("SELECT painter_fk FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $painter_fk = $stmt->fetchColumn();

    if ($painter_fk) {
        // Consultar la base de datos para obtener los cupcakes asociados al pintor favorito
        $stmt = $conn->prepare("SELECT id, title, img, description, period, technique, year FROM paintings WHERE painter_fk = ?");
        $stmt->execute([$painter_fk]);
        $cupcakes = $stmt->fetchAll();

        // Agregar la ruta relativa a la carpeta img
        foreach ($cupcakes as &$cupcake) {
            $cupcake['img'] = 'img/' . $cupcake['img'];
        }
    } else {
        // Si no se encuentra el usuario o no tiene un pintor favorito, redirigir al archivo de inicio de sesión
        header('Location: login.php');
        exit();
    }

    // Renderizar la plantilla de cupcakes
    echo $blade->run("cupcakes", ["cupcakes" => $cupcakes]);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
