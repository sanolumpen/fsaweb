<?php
require_once "controlador/cusuario.php";
require_once "core/sesion.php";
$usuario = new CUsuario();
$sesion = new Sesion();//iniciamos la sesion_start()
$error = "";

//validar la sesion

if(isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada']==true ){
  include_once "vista/home.php";
}else{
if(isset($_POST['btnIniciar'])){

  $validar = $usuario->validarU($_POST['txtUsuario'], $_POST['txtClave']);
  if($validar == true){
        $_SESSION['sesion_iniciada'] = true;
        $datos = $usuario->datosUsuario($_POST['txtUsuario'], $_POST['txtClave']);
        // nombre de usuario es nombre real
        $_SESSION['nombreUsuario'] = $datos['NombreCompleto'];
        // el usuario es el nickname
        $_SESSION['usuario'] = $datos['Usuario'];
        // el rol es el rol :V (si es administrativo, de comité o usuario común)
        $_SESSION['rol'] = $datos['IdRol'];
        $_SESSION['correo'] = $datos['Correo'];
        include_once "vista/home.php";
  }else{
       $error = "<div class='alert alert-danger alert-dismissible' role='alert'>
         <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
         </button>
         <strong>Error al iniciar sesión</strong> Usuario y/o contraseña incorrecta.
       </div>";
       include_once "vista/vlogin.php";
  }
}else{
  require_once "vista/vlogin.php";
}

}
 ?>
