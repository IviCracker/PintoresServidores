<?php
require '../vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

class Modelo {
    private static $conn;

    public static function conectar() {
        // Configuración de la base de datos
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $dbname = "usermgmt";

        try {
            self::$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }

    public static function verificarCredenciales($username, $password) {
        // Conexión a la base de datos (debes reemplazar estos valores con los de tu propia configuración)
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
                    // Credenciales válidas
                    return [
                        'user_id' => $result[0]['id'],
                        'nombre_usuario' => $result[0]['name']
                    ];
                }
            }

            // Credenciales inválidas
            return false;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }

    public static function obtenerNombreUsuario($user_id) {
        self::conectar();
    
        try {
            // Consultar la base de datos para obtener el nombre de usuario
            $stmt = self::$conn->prepare("SELECT name FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $nombre_usuario = $stmt->fetchColumn();
    
            return $nombre_usuario;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }
    public static function obtenerContraseñaUsuario($user_id) {
        self::conectar();
    
        try {
            // Consultar la base de datos para obtener el nombre de usuario
            $stmt = self::$conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $nombre_usuario = $stmt->fetchColumn();
    
            return $nombre_usuario;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }
    public static function obtenerEmailUsuario($user_id) {
        self::conectar();
    
        try {
            // Consultar la base de datos para obtener el nombre de usuario
            $stmt = self::$conn->prepare("SELECT email FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $nombre_usuario = $stmt->fetchColumn();
    
            return $nombre_usuario;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }

    public static function obtenerCupcakesUsuario($user_id) {
        self::conectar();

        try {
            // Consultar la base de datos para obtener los cupcakes asociados al usuario
            $stmt = self::$conn->prepare("SELECT p.id, p.title, p.img, p.description, p.period, p.technique, p.year 
                                    FROM paintings p 
                                    INNER JOIN users u ON p.painter_fk = u.painter_fk 
                                    WHERE u.id = ?");
            $stmt->execute([$user_id]);
            $cupcakes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Agregar la ruta relativa a la carpeta img
            foreach ($cupcakes as &$cupcake) {
                $cupcake['img'] = '../img/' . $cupcake['img'];
            }

            return $cupcakes;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }
    public static function actualizarUsuario($user_id, $name, $email, $password, $painter_fk) {
        self::conectar();

        try {
            // Actualizar los datos del usuario en la base de datos
            $stmt = self::$conn->prepare("UPDATE users SET name = :name, email = :email, password = :password, painter_fk = :painter_fk WHERE id = :user_id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':painter_fk', $painter_fk);
            $stmt->bindParam(':user_id', $user_id);

            return $stmt->execute();
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }

    public static function obtenerPintores() {
        self::conectar();
    
        try {
            $stmt = self::$conn->query("SELECT id, name FROM painters");
            $pintores = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pintores;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function eliminarUsuario($user_id) {
        self::conectar();
    
        try {
            // Preparar la consulta para eliminar el usuario
            $stmt = self::$conn->prepare("DELETE FROM users WHERE id = ?");
            // Ejecutar la consulta con el ID del usuario como parámetro
            $stmt->execute([$user_id]);
            // Devolver true si la eliminación fue exitosa
            return true;
        } catch(PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }


    public static function cerrarSesion() {
        // Iniciar la sesión si aún no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Eliminar todas las variables de sesión
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();
    }
    public static function registrarUsuario($username, $email, $contraseña, $painter_fk) {
        self::conectar();
    
        try {
            // Preparar la consulta SQL para insertar un nuevo usuario
            $stmt = self::$conn->prepare("INSERT INTO users (name, password, email, painter_fk) VALUES (?, ?, ?, ?)");
    
            // Verificar si la consulta SQL es válida
            if ($stmt === false) {
                return false;
            }
    
            // Ejecutar la consulta
            $stmt->execute([$username, $contraseña, $email, $painter_fk]);
    
            // Cerrar la consulta
            $stmt->closeCursor();
            
            return true;
        } catch (PDOException $e) {
            // Mostrar mensaje de error al registrar el usuario
            echo "Error al registrar el usuario: " . $e->getMessage();
            return false;
        } 
    }
    public static function existeNombreUsuario($username, $excludeUserId = null) {
        self::conectar();
        
        try {
            // Preparar la consulta SQL para verificar si ya existe un usuario con el mismo nombre
            $sql = "SELECT COUNT(*) FROM users WHERE name = ?";
            // Si se proporciona un ID de usuario a excluir, exclúyelo de la verificación
            if ($excludeUserId !== null) {
                $sql .= " AND id <> ?";
            }
            $stmt = self::$conn->prepare($sql);
            if ($excludeUserId !== null) {
                $stmt->execute([$username, $excludeUserId]);
            } else {
                $stmt->execute([$username]);
            }
            $count = $stmt->fetchColumn();
            
            return $count > 0; // Devuelve true si ya existe un usuario con el mismo nombre, false de lo contrario
        } catch (PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }
    
    public static function existeCorreoUsuario($email, $excludeUserId = null) {
        self::conectar();
        
        try {
            // Preparar la consulta SQL para verificar si ya existe un usuario con el mismo correo electrónico
            $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
            // Si se proporciona un ID de usuario a excluir, exclúyelo de la verificación
            if ($excludeUserId !== null) {
                $sql .= " AND id <> ?";
            }
            $stmt = self::$conn->prepare($sql);
            if ($excludeUserId !== null) {
                $stmt->execute([$email, $excludeUserId]);
            } else {
                $stmt->execute([$email]);
            }
            $count = $stmt->fetchColumn();
            
            return $count > 0; // Devuelve true si ya existe un usuario con el mismo correo electrónico, false de lo contrario
        } catch (PDOException $e) {
            // Manejar errores de la base de datos aquí
            return false;
        }
    }
    public static function validarContraseña($password) {
        // Validar si la contraseña cumple con los criterios requeridos
        if (strlen($password) < 4) {
            return false; // Contraseña demasiado corta
        }
    
        if (!preg_match('/[A-Z]/', $password)) {
            return false; // No hay al menos una mayúscula
        }
    
        if (!preg_match('/[a-z]/', $password)) {
            return false; // No hay al menos una minúscula
        }
    
        if (!preg_match('/[^a-zA-Z\d]/', $password)) {
            return false; // No hay al menos un carácter especial
        }
    
        return true; // Contraseña válida
    }
    
}
?>
