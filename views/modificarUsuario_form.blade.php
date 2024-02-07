<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>

    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
                        <form method="POST" action="modificar.php">
                            @csrf
                            <div class="form-group">
                                <label for="username">Nombre de usuario:</label>
                                <input type="text" id="username" name="username" class="form-control" value="{{ $username }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $email }}">
                            </div>
                            <div class="form-group">
                                <label for="favorite_painter">Pintor favorito:</label>
                                <select id="favorite_painter" name="favorite_painter" class="form-control">
                                    @foreach ($painters as $painter)
                                    <option value="{{ $painter['id'] }}" @if ($painter['id'] == $favorite_painter) selected @endif>{{ $painter['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="eliminar_cuenta.php" class="btn btn-danger">Eliminar Cuenta</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
