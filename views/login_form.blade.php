<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="controlador_login.php">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name" ><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" ><br>
        
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" ><br>
        
        <label for="painter">Pintor:</label><br>
        <select id="painter" name="painter">
            <?php foreach ($painters as $painter): ?>
                <option value="<?php echo $painter['id']; ?>"><?php echo $painter['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <button type="submit" name="registrarse" class="btn btn-danger">Registrarse</button>
        <button type="submit" name="volverInicio" class="btn btn-danger">Volver al inicio</button>
    </form>
</body>
</html>
