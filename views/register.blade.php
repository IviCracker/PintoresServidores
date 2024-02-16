<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="controlador_register.php">
        <label for="username">Nombre:</label><br>
        <input type="text" id="username" name="username" ><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" ><br>
        
        <label for="contraseña">Contraseña:</label><br>
        <input type="contraseña" id="contraseña" name="contraseña" ><br>
        
        <label for="painter">Pintor:</label><br>
        <select id="painter" name="painter">
            @foreach ($painters as $painter)
                <option value="{{ $painter['id'] }}">{{ $painter['name'] }}</option>
            @endforeach
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
