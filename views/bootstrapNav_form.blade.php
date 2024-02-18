<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title> <!-- Título con el nombre del usuario -->

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Roboto:300,400,500">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/style.css">

   
<style>
    
    .top-content{
        background-image: url(../assets/img/backgrounds/1.jpg);
            }

            .navbar-no-bg {
    padding-top: 10px;
    padding-bottom:10px;
    background: #1a4743f0;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}
</style>
</head>

<body>

    <!-- Top menu -->
    <nav class="navbar navbar-fixed-top navbar-no-bg" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="top-navbar-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../controladores/controlador_arte.php">Inicio</a></li>
                    <li><a href="../controladores/controlador_login.php">Inicio De Sesion</a></li>
                    <li><a href="../controladores/controlador_modificarUsuario.php">Modificar Usuario</a></li>

                    <li><a class="btn btn-link-3" href="../controladores/controlador_logout.php">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Top content -->
    <div class="top-content" >
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text wow fadeInLeft">
                <h1>Museo Personal de {{ $nombre_usuario }}</h1>
                    <div class="description">
                        <p class="medium-paragraph">
                        Explora una selección de tus cuadros favoritos en nuestra página web y sumérgete en la belleza del arte desde la comodidad de tu hogar. Descubre obras maestras que cautivarán tu imaginación y enriquecerán tu vida.                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>
