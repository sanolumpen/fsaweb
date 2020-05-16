<!-- esta página se encarga de enrutar hacia las demás -->
<!-- this page returns the other pages in the user system -->
<?php
require_once "core/sesion.php";
if (isset($_POST['btnCerrar'])) {
  $cerrar = new Sesion();
  $cerrar->cerrarSesion(); //llamar metodo para destruir la sesion
  $_SESSION['sesion_iniciada'] = false;
  header("Location: log.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>UserSys | FSA</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/2038768ebc.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="./libs/js/jquery-3.4.1.min.js"></script>
</head>

<body style="background-color:#323232;font-family: Lato, sans-serif;color:#fff;">

  <div class="row">
    <!-- menu izquierdo-->
    <div class="col-md-2">
      <ul class="nav nav-pills nav-stacked">
        <li><center><span style="color:#fff"><b>Bienvenido,</b><br><?php echo $_SESSION['nombreUsuario']; ?></span></center></li>
        <li><br></li>
        <li><a href="?vista=inicio" style="background-color:#c82e46;color: #FFF;">Home</a></li>
        <li><a href="?vista=vGestionU" style="color: #FFF; background-color:#e1576d;"> Gestión de usuarios</a></li>
        <li><a href="?vista=vNoticias" style="color: #FFF; background-color:#e1576d;">Gestión de noticias</a></li>
        <li><a href="?vista=vGestionDi" style="color: #FFF; background-color:#e1576d;">Gestión de diseño</a></li>
        <li><a href="?vista=vGestionReportes" style="color: #FFF; background-color:#e1576d;">Gestión de Reportes</a></li>
        <li><a href="?vista=vGestionContacto" style="color: #FFF; background-color:#e1576d;">Gestión de PQRS</a></li>
        <li><a href="?vista=vGestionJoinUs" style="color: #FFF; background-color:#e1576d;">Gestión de Joins</a></li>
      </ul>
    </div>

    <!-- contenido principal -->
    <div class="col-md-9">
      <div class="right_col" role="main">
        <div class="">
          <div>
            <?php
            require_once "core/enrutador.php";
            $enrutador = new Enrutador();
            if (isset($_GET['vista'])) {
              $enrutador->cargarVista($_GET['vista']);
            } else {
              $enrutador->cargarVista("inicio");
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- menu derecho -->
    <div class="col-md-1">
      <br>
      <br>
      <br>
      <br>
      <button class="btn btn-danger" data-toggle="collapse" data-target="#clpAcciones">Acciones</button>

      <div id="clpAcciones" class="collapse">
        <ul class="nav nav-pills nav-stacked">
          <center>
            <li role="presentation" class="nav-item dropdown open">
              <a class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o" style="color: #FFF;"></i>
                <span class="badge bg-green">1</span>
              </a>
              <ul class=" dropdown-menu dropdown-menu-right list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                <li class="nav-item">
                  <a class="dropdown-item">
                    <!-- <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span> -->
                    <span>
                      <span><b><i class="fa fa-user"></i> KurahaSho Admin</b></span>
                      <br>
                      <span class="text-muted"><i class="fa fa-clock"></i> Cuando me fui a dormir</span>
                    </span>
                    <br>
                    <span class="message">
                      Me gustan las altas y las chaparritas :v
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <div class="text-center">
                    <a class="dropdown-item">
                      <strong>ver todas las notificaciones</strong>
                      <i class="fa fa-angle-left"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
            <li><br></li>
            <li>
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true" style="color: #FFF;"></span>
              </a>
            </li>
            <li><br></li>
            <li>
              <form method="post">
                <button type="submit" name="btnCerrar" style="background-color:transparent; border-color:transparent;"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
              </form>
            </li>
          </center>
        </ul>
      </div>
    </div>
  </div>
  
  <br>
  <br>
  <div class="footer " style="background-color:#333;">
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
            <h4><i class="fa fa-envelope"></i>federacion.shogi.america@gmail.com</h4>
          </center>
        </div>
      </div>
    </div>
    <center>
      <h3><i class="fas fa-laugh-wink"></i> Federación de Shogi Americana</h3>
      <p>©2020 Algunos Derechos Reservados. FSA usa Bootstrap 3. Términos y Condiciones</p>
    </center>
    <!-- <a href="?vista=vTrabajo" style="color:#000000;">Ingreso a Trabajadores</a> -->
  </div>
</body>

</html>