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

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

        $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, password = :password, painter_fk = :painter_fk WHERE id = :user_id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':painter_fk', $painter_fk);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            header('Location: arte.php');
            exit();
        } else {
            echo "Error al actualizar los datos del usuario.";
        }
    }

    $stmt_user = $conn->prepare("SELECT name, email, painter_fk FROM users WHERE id = :user_id");
    $stmt_user->bindParam(':user_id', $user_id);
    $stmt_user->execute();
    $row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    if ($row_user) {
        $name = $row_user['name'];
        $email = $row_user['email'];
        $painter_fk = $row_user['painter_fk'];
    } else {
        echo "Error: No se pudo obtener la información del usuario.";
        exit();
    }

    $stmt_painters = $conn->query("SELECT id, name FROM painters");
    $painters = $stmt_painters->fetchAll(PDO::FETCH_ASSOC);

    echo $blade->run("modificarUsuario_form", ["name" => $name, "email" => $email, "painters" => $painters]);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
