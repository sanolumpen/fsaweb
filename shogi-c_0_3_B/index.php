<!DOCTYPE html>
<html lang="es">

<head>
    <title>FSA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap css 3 y 4 respectivamente -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- kit de iconos de fontawesome -->
    <script src="https://kit.fontawesome.com/2038768ebc.js" crossorigin="anonymous"></script>
    <!-- fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="./libs/js/jquery-3.4.1.min.js"></script>
</head>

<body style="background-color:#323232;font-family: Lato, sans-serif;color:#fff;">
<!-- this tag is the main navbar of the page -->

<!-- Inicio de barra de navegación -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#333;border-color:#333;font-family: Montserrat, sans-serif;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="border-color:#000000;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav navbar-nav navbar-right" id="myNavbar">
                <div class="nav navbar-brand">
                    <p><b>Federación de Shogi Americana</b></p>
                </div>
                <img src="./view/recursos/logoFasa.png" alt="" class="img-fluid float-left" alt="logo Fasa" style="max-width:4%">
                <!-- botones barra de navegación -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- botón que redirige a la sección de noticias -->
                    <li><a href="?vista=vInicio" style="color:#FFF;background-color:#c82e46;border-radius:10%">INICIO</a></li>
                    <li style="color:#333;">|||</li>
                    <!-- botón que redirige a la sección de diseño -->
                    <li><a href="?vista=vDiseno" style="color:#FFF;background-color:#c82e46;border-radius:10%">Diseño</a></li>
                    <li style="color:#333;">|||</li>
                    <!-- botón que redirige a la sección de gestión de usuarios -->
                    <li><a href="./userSys/log.php" style="color:#FFF;background-color:#c82e46;border-radius:10%">LOGIN</a></li>
                    <li style="color:#333;">|||</li>
                    <!-- botón que redirige a la sección de contacto -->
                    <li><a href="?vista=vContacto" style="color:#FFF;background-color:#c82e46;border-radius:10%">Contáctanos</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin de barra de navegación -->
    <!-- this div is a container for the main title of start page -->
    <div class="jumbotron text-capitalize text-center" style="background-color:#333;border-color:#444;font-family: Montserrat, sans-serif;">
        <h2 style="color:#c82e46"><b>Hola, aquí también jugamos shogi! :)</b></h2>
    </div>
    <br>
    <?php
    // the enrutador (router) is a module of php, returns a view in the actual page
    // el siguiente bloque de php toma la variable vista y se la envía al enrutador
    // enrutador retorna una página por medio de un require
    require "core/enrutador.php";
    $enrutador = new enrutador();

    if (!isset($_GET["vista"])) {
        $enrutador->cargarvista("vInicio");
    } else {
        $enrutador->cargarvista($_GET["vista"]);
    }


    ?>
    <br>
    <!-- the footer with contact and legal information -->
    <div class="footer" style="background-color:#333;">
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <center>
                        <h4><i class="fa fa-whatsapp"></i> (+56) 933-204-806</h4>
                    </center>
                </div>
                <div class="col-md-6">
                    <center>
                        <h4><i class="fa fa-envelope"></i> federacion.shogi.america@gmail.com</h4>
                    </center>
                </div>
            </div>
        </div>
        <center>
            <h3><i class="fas fa-laugh-wink"></i> Federación de Shogi Americana (Pre-Alpha)</h3>
            <p>©2020 Algunos Derechos Reservados. FSA usa Bootstrap 3. Términos y Condiciones</p>
        </center>
        <!-- <a href="?vista=vTrabajo" style="color:#000000;">Ingreso a Trabajadores</a> -->
        <!-- this link is for the bug-report -->
        <a href="?vista=vDev-report"><b>Sugerencias al desarrollador</b></a>
    </div>
</body>

</html>