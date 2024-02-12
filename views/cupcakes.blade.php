<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Cuadros</title>

    <style>
        /* Estilos para las imágenes de los cuadros */
        .card-img-top {
            height: 300px; /* Altura fija para todas las imágenes */
            object-fit: cover; /* Hace que las imágenes se ajusten al tamaño sin deformarlas */
            border: 5px solid transparent; /* Borde transparente */
            transition: border-color 0.3s; /* Transición suave del color del borde */
        }

        .card-img-top:hover {
            border-color: black; /* Color del borde al pasar el mouse */
        }
        .card-img-top{
            item-align: left;
        }
    </style>
</head>
<body>
    

<div class="container">
    <h1>Cuadros favoritos
        <small class="text-muted">Cuadros</small>
    </h1>
    <div class="row" id="cupcakeDetails">
        @foreach($cupcakes as $cupcake)
        <div class="col-md-4">
            <div class="card">
                <img src="{{$cupcake['img']}}" class="card-img-top" alt="{{$cupcake['title']}}" onclick="showCupcakeDetails({{json_encode($cupcake)}})">
                <div class="card-body">
                    <h5 class="card-title">{{$cupcake['title']}}</h5>
                </div>
            </div>
            <br>
        </div>
        @endforeach
    </div>
    <a href="logout.php"  class="btn btn-danger">Volver al inicio</a>
    <a href="modificarUsuario.php"  class="btn btn-danger">Modificar Usuario</a>
</div>

<script>
    function showCupcakeDetails(cupcake) {
        // Construir el HTML con la información del cuadro seleccionado
        var cupcakeDetailsHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img src="${cupcake['img']}" class="card-img-top" alt="${cupcake['title']}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${cupcake['title']}</h5>
                            <p class="card-text">Descripción: ${cupcake['description']}</p>
                            <p class="card-text">Período: ${cupcake['period']}</p>
                            <p class="card-text">Técnica: ${cupcake['technique']}</p>
                            <p class="card-text">Año: ${cupcake['year']}</p>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-danger" onclick="hideCupcakeDetails()">Cerrar</button>
                </div>
            </div>
        `;

        // Mostrar la información del cuadro seleccionado
        document.getElementById('cupcakeDetails').innerHTML = cupcakeDetailsHTML;
    }

    function hideCupcakeDetails() {
        // Recargar la página para volver al estado original
        location.reload();
    }
</script>


</body>
</html>
