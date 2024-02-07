<!DOCTYPE html>
<html>
<head>
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <h2>Modificar Usuario</h2>
    <form method="POST" action="modificar.php">
        <!-- Aquí puedes incluir los campos para modificar el usuario -->
    </form>

    <h2>Registro de Usuario</h2>
    <form method="POST" action="register.php">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name" ><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" ><br>
        
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" ><br>
        
        <label for="painter">Pintor:</label><br>
        <select id="painter" name="painter">
    @foreach ($painters as $painter)
        <option value="{{ $painter['id'] }}">{{ $painter['name'] }}</option>
    @endforeach
</select>

        
        <button type="submit" class="btn btn-danger">Registrarse</button>
        <a href="login.php" class="btn btn-danger">Volver al inicio</a>
    </form>
</body>
</html>
