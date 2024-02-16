<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>

    <!-- Estilos Bootstrap -->
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
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
                        <button type="submit" name="guardar_cambios" class="btn btn-primary">Guardar Cambios</button>
                        <button type="submit" name="eliminar_cuenta" class="btn btn-danger">Eliminar Cuenta</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
