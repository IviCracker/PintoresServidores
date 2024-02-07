<?php
require 'vendor/autoload.php';
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usermgmt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $painter_fk = $_POST['painter']; // Cambiado de 'painter' a 'painter_fk'

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, painter_fk = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $email, $password, $painter_fk, $user_id);

    if ($stmt->execute()) {
        header('Location: arte.php');
        exit();
    } else {
        echo "Error al actualizar los datos del usuario: " . $stmt->error;
    }

    $stmt->close();
}

$sql_user = "SELECT name, email, painter_fk FROM users WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows == 1) {
    $row_user = $result_user->fetch_assoc();
    $name = $row_user['name'];
    $email = $row_user['email'];
    $painter_fk = $row_user['painter_fk'];
} else {
    echo "Error: No se pudo obtener la información del usuario.";
    exit();
}


// Obtener la lista de pintores desde la base de datos
$sql = "SELECT id, name FROM painters";
$result = $conn->query($sql);

// Verificar si la consulta SQL es válida
if ($result === false) {
    die("Error al ejecutar la consulta: " . $conn->error);
}

// Obtener los pintores
$painters = [];
while ($row = $result->fetch_assoc()) {
    $painters[] = $row;
}

// Cerrar la conexión a la base de datos
$conn->close();


echo $blade->run("modificarUsuario_form", ["name" => $name, "email" => $email, "painters" => $painters]);
?>
