<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    padding: 20px;
}
body{
    background-image: url("../assets/img/backgrounds/login.jpg");
    height: 80vh;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.login-container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.error-message {
    color: red;
    margin-bottom: 10px;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form input[type="submit"],
form input[type="button"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

form input[type="submit"]:hover,
form input[type="button"]:hover {
    background-color: #0056b3;
}

.register-button {
    text-decoration: none;
    display: inline-block;
    width: 100%;
}

.register-button input[type="button"] {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

.register-button input[type="button"]:hover {
    background-color: #218838;
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
            <input type="text" name="username" placeholder="Nombre de usuario" class="<?= !empty($username_error) ? 'error' : '' ?>" required><br>
            <?php if (!empty($username_error)): ?>
                <p class="error-message"><?= $username_error ?></p>
            <?php endif; ?>
            <input type="password" name="password" placeholder="Contraseña" class="<?= !empty($password_error) ? 'error' : '' ?>" required><br>
            <?php if (!empty($password_error)): ?>
                <p class="error-message"><?= $password_error ?></p>
            <?php endif; ?>
            <input type="submit" value="Iniciar sesión">
            <br><br>
            <a href="controlador_register.php" class="register-button"><input type="button" value="Registrarse"></a>
        </form>
    </div>
</body>
</html>
