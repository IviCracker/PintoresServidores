<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        /* Estilos CSS para mejorar la apariencia del formulario (puedes personalizarlos según tus necesidades) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            margin-top: 0;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .register-button {
            background-color: #007bff;
        }
        .register-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <?php if(isset($error_message)): ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Nombre de usuario" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar sesión">
            <a href="controlador_register.php" class="register-button"><input type="button" value="Registrarse"></a>
        </form>
    </div>
</body>
</html>
