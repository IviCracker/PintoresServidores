<?php
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usermgmt";

// Intentar establecer la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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


    // Preparar la consulta SQL para insertar un nuevo usuario
    $stmt = $conn->prepare("INSERT INTO users (name, password, email, painter_fk) VALUES (?, ?, ?, ?)");

    // Verificar si la consulta SQL es válida
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Enlazar los parámetros y ejecutar la consulta
    $stmt->bind_param("sssi", $name, $password, $email, $painter_fk);
    if ($stmt->execute() === TRUE) {
        // Mostrar mensaje de registro exitoso
        echo "Registro exitoso";
    } else {
        // Mostrar mensaje de error al registrar el usuario
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar la consulta
    $stmt->close();
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

// Renderizar el formulario de registro con la lista de pintores
echo $blade->run("register", ["painters" => $painters]);
?>
