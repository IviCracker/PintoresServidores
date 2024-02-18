<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <style>
    /* Estilos específicos para el formulario de Modificar Usuario */
    .top-content{
        
        
    background-image: url(../assets/img/backgrounds/cuadro.jpg);
        
            }
    .modify-user-form {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .modify-user-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 50px;
         /* Altura del viewport */
    }
    </style>
</head>
<body class="modify-user-form">
    <div class="modify-user-container">
        <div class="row justify-content-center">
            <div class="columna">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Modificar Usuario</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="controlador_modificarUsuario.php">
                            @csrf
                            <div class="form-group">
                                <label for="username">Nombre de usuario:</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ $name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="painter">Pintor favorito:</label>
                                <select id="painter" name="painter" class="form-control">
                                    @foreach ($pintores as $pintor)
                                        <option value="{{ $pintor['id'] }}">{{ $pintor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" name="guardar_cambios" class="btn-primary mr-2">Guardar Cambios</button>
                            <button type="submit" name="eliminar_cuenta" class="btn-danger">Eliminar Cuenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
