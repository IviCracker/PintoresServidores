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

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no está autenticado, redirigir al formulario de inicio de sesión
    header('Location: login.php');
    exit();
}

// Obtener el ID del usuario autenticado
$user_id = $_SESSION['user_id'];

// Verificar si se ha enviado el formulario de modificación de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar los datos del formulario
    // Aquí deberías realizar la lógica para actualizar los datos del perfil en la base de datos
    // Puedes obtener los datos del formulario utilizando $_POST['campo'] y actualizar la base de datos según sea necesario

    // Si se ha enviado el formulario para darse de baja
    if (isset($_POST['delete_account'])) {
        // Aquí deberías realizar la lógica para eliminar la cuenta del usuario de la base de datos
        // Después de eliminar la cuenta, debes redirigir al usuario al formulario de inicio de sesión o a una página de confirmación
    }

    // Redirigir al usuario a una página de confirmación o a otra ubicación según sea necesario
    // header('Location: confirmacion.php');
    // exit();
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

// Renderizar la vista para modificar el perfil
echo $blade->run("modificarUsuario_form", ["user_id" => $user_id, "painters" => $painters]);
?>
