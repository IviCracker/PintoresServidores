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

// Realizar una consulta SQL para obtener el pintor favorito del usuario
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "usermgmt";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT painter_fk FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $painter_fk = $row['painter_fk'];
} else {
    // Si no se encuentra el usuario, redirigir al archivo de inicio de sesión
    header('Location: login.php');
    exit();
}

// Consultar la base de datos para obtener los cupcakes asociados al pintor favorito
// Consultar la base de datos para obtener los cupcakes asociados al pintor favorito
$stmt = $conn->prepare("SELECT id, title, img, description, period, technique, year FROM paintings WHERE painter_fk = ?");
$stmt->bind_param("i", $painter_fk);
$stmt->execute();
$result = $stmt->get_result();

$cupcakes = [];

while ($row = $result->fetch_assoc()) {
    $row['img'] = 'img/' . $row['img']; // Ruta relativa a la carpeta img
    $cupcakes[] = $row;
}

// Renderizar la plantilla de cupcakes
echo $blade->run("cupcakes", ["cupcakes" => $cupcakes]);
?>
