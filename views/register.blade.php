<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-image:  url("../assets/img/backgrounds/register.jpeg");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

h2 {
    text-align: center;
}

form {
    max-width: 400px;
    margin: 0 auto;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"],
form input[type="password"],
form select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form button[type="submit"],
form input[type="button"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #28a745;
    border: none;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
}

form button[type="submit"]:hover,
form input[type="button"]:hover {
    background-color: #218838;
}

.register-button {
    text-decoration: none;
}

.register-button input[type="button"] {
    width: auto;
}
.error-message {
    color: red;
    
}

</style>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="controlador_register.php">
        <label for="username">Nombre:</label><br>
        <input type="text" id="username" name="username" >
        <?php if (!empty($error_username)): ?>
            <p class="error-message"><?= $error_username ?></p>
        <?php endif; ?>
        <br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" >
        <?php if (!empty($error_email)): ?>
            <p class="error-message"><?= $error_email ?></p>
        <?php endif; ?>
        <br>
        
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" >
        <?php if (!empty($error_password)): ?>
            <p class="error-message"><?= $error_password ?></p>
        <?php endif; ?>
        <br>
        
        <label for="painter">Pintor:</label><br>
        <select id="painter" name="painter">
            <?php foreach ($painters as $painter): ?>
                <option value="<?= $painter['id'] ?>"><?= $painter['name'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <input type="hidden" name="action" value="registrarse"> <!-- Campo oculto para identificar la acción -->
        <button type="submit" name ="registrarse"class="btn btn-danger">Registrarse</button>
    </form>
    <form method="POST" action="controlador_register.php">
        <input type="hidden" name="action" value="volverInicio"> <!-- Campo oculto para identificar la acción -->
        <a href="controlador_login.php" class="register-button"><input type="button" value="Volver"></a>
    </form>
</body>
</html>