<?php
require_once dirname(__DIR__) . "/controlador/cusuario.php";
$usuario = new CUsuario();


// Este if guarda usuarios
if (isset($_POST['btnGuardar'])) {
  $insert = $usuario->insertarU(
    $_POST['txtUsuario'],
    $_POST['txtClave'],
    $_POST['txtNombre'],
    $_POST['txtCorreo'],
    2,
    1
  );

// Este bloque evalúa errores
  if ($insert == true) {
    //libreria para generar una alerta (sweetalert)
    $_SESSION['alerta'] = '
          swal({
              title: "Registro exitoso",
              type: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              closeOnCancel: false
          });
      ';
  } else {
    $_SESSION['alerta'] = '
      swal({
          title: "Error en el registro comuniquese con soporte",
          type: "error",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: false
      });
    ';
  }
}
?>

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
    <a href="../../index.php"><button class="btn btn-danger">Regresar</button></a>
    <br><br>
    <div class="panel panel-default" style="background-color:#333;border-color:#c82e46">
      <div class="panel-heading" style="background-color:#c82e46">
        <center>
          <h1>Crear Cuenta</h1>
        </center>
      </div>
      <div class="panel-body">
        <form method="post">
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 ">Nombre Completo</label>
            <div class="col-md-9 col-sm-9 ">
              <input type="text" class="form-control" name="txtNombre" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 ">Correo</label>
            <div class="col-md-9 col-sm-9 ">
              <input type="email" class="form-control" name="txtCorreo" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 ">Usuario</label>
            <div class="col-md-9 col-sm-9 ">
              <input type="text" class="form-control" name="txtUsuario" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 ">Contraseña<span class="required"></span>
            </label>
            <div class="col-md-9 col-sm-9 ">
              <input class="form-control" required="required" id="pass1" name="txtClave" type="password">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 ">Confirmar Contraseña<span class="required"></span>
            </label>
            <div class="col-md-9 col-sm-9 ">
              <input class="form-control" required="required" id="pass2" name="txtClave" type="password">
            </div>
          </div>
      </div>

      <div class="ln_solid"></div>
      <div class="form-group row" style="margin-left:4%;">
        <div class="col-md-9 col-sm-9  offset-md-3">
          <button class="btn btn-danger" type="reset">Limpiar</button>
          <button type="submit" name="btnGuardar" class="btn btn-success"> Guardar</button>
        </div>
      </div>
      </form>
      <!-- <a class="reset_pass" href="#">Lost your password?</a> -->


      <div class="separator" style="margin-left:4%;">
        <p class="change_link">Ya tiene cuenta?
          <a href="../log.php"> Iniciar Sesión </a>
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


  <script type="text/javascript">
  var pass1, pass2;
  pass1 = document.getElementById('pass1');
  pass2 = document.getElementById('pass2');
  pass1.onchange = pass2.onkeyup = passwordMatch;

  function passwordMatch() {
    if (pass1.value !== pass2.value) {
      pass2.setCustomValidity('Las contraseñas no coinciden');
    } else {
      pass2.setCustomValidity('');
    }
  }
</script>
</body>
</html>

