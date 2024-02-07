<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h2 class="mb-0">Iniciar sesión</h2>
                    </div>
                    <div class="card-body">
                        @if(isset($error_message))
                            <div class="alert alert-danger" role="alert">
                                {{ $error_message }}
                            </div>
                        @endif
                        <form method="POST" action="login.php">
                            @csrf
                            <div class="form-group">
                                <label for="username">Nombre de usuario:</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-danger">Iniciar sesión</button>
                            <a href="register.php" class="btn btn-outline-danger">Crear Cuenta</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
