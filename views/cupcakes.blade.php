<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Cuadros</title>
</head>
<body>

<div class="container">
    <h1>Cuadros favoritos
        <small class="text-muted">Cuadros</small>
    </h1>
    <div class="row">
        @foreach($cupcakes as $cupcake)
        <div class="col-md-4">
            <div class="card">
                <img src="{{$cupcake['img']}}" class="card-img-top" alt="{{$cupcake['title']}}">
                <div class="card-body">
                    <h5 class="card-title">{{$cupcake['title']}}</h5>
                    <p class="card-text">Description: {{$cupcake['description']}}</p>
                    <p class="card-text">Period: {{$cupcake['period']}}</p>
                    <p class="card-text">Technique: {{$cupcake['technique']}}</p>
                    <p class="card-text">Year: {{$cupcake['year']}}</p>
                </div>
            </div>
            <br>
        </div>
        @endforeach
        <a href="logout.php"  class="btn btn-danger">Volver al inicio</a>
        <a href="modificarUsuario.php"  class="btn btn-danger">Modificar Usuario</a>
    </div>
</div>

</body>
</html>
