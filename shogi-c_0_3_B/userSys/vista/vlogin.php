
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login | FSA</title>

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
  <div class="container">
    <a href="../index.php"><button class="btn btn-danger">Regresar</button></a>
    <br><br>
    <div class="panel panel-default" style="background-color:#333;border-color:#c82e46">
      <div class="panel-heading" style="background-color:#c82e46">
        <center>
          <h1>Iniciar Sesión</h1>
        </center>
      </div>
      <div class="panel-body">
        <form method="post">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <input type="text" name="txtUsuario" class="form-control" placeholder="Usuario" required="" />
            </div>
            <br>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <input type="password" name="txtClave" class="form-control" placeholder="Contraseña" required="" min-length="8"/>
            </div>
          </div>
          <br>
          <div class="row">
            <!-- <a class="btn btn-default submit" href="index.html">Log In</a> -->
            <center><button type="submit" class="btn btn-default submit" name="btnIniciar">Iniciar</button></center>

            <div class="clearfix"></div>
            <div class="form-group">
            <!-- El bloque de php evalúa si existe un error y lo muestra -->
              <?php
              if (isset($error) && $error !== "") {
                echo $error;
              }

              ?>
            </div>
        </form>
        <!-- <a class="reset_pass" href="#">Lost your password?</a> -->

        <!-- redirige a la página de registro de usuarios -->
        <div class="separator" style="margin-left:4%;">
          <p class="change_link">No tiene cuenta?
            <a href="./vista/vCrearU-Pub.php"> Crear Cuenta </a>
          </p>
        </div>
      </div>
    </div>

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
              <h4><i class="fa fa-envelope"></i> gallardoceron@gmail.com</h4>
            </center>
          </div>
        </div>
      </div>
      <center>
        <h3><i class="fas fa-laugh-wink"></i> Federación de Shogi Americana (Pre-Alpha)</h3>
        <p>©2020 Algunos Derechos Reservados. FSA usa Bootstrap 3. Términos y Condiciones</p>
      </center>
      <!-- <a href="?vista=vTrabajo" style="color:#000000;">Ingreso a Trabajadores</a> -->
    </div>
  </div>
</body>

</html>