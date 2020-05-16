<?php
require_once dirname(__DIR__)."/modelo/musuario.php";
class CUsuario{

public $modeloUsuario;

public function __construct(){
  $this->modeloUsuario = new MUsuario();
}

public function validarU($user, $pass){
  $this->modeloUsuario->__SET("usuario", $user);
  $this->modeloUsuario->__SET("clave", md5(sha1(sha1($pass))));
  $res = $this->modeloUsuario->validarUsuario();
  return $res;
}

public function datosUsuario($user, $pass){
  $this->modeloUsuario->__SET("usuario", $user);
  $this->modeloUsuario->__SET("clave", md5(sha1(sha1($pass))));
  $datos = $this->modeloUsuario->getDatosUsuario();
  return $datos;
}



public function listarU(){
  $tabla = $this->modeloUsuario->listarUsuarios();
  return $tabla;
}

public function editarU($usuario, $nombreC, $correo, $idRol, $idUsuario){
  $this->modeloUsuario->__SET("usuario", $usuario);
  $this->modeloUsuario->__SET("nombreCompleto", $nombreC);
  $this->modeloUsuario->__SET("correo", $correo);
  $this->modeloUsuario->__SET("idRol", $idRol);
  $this->modeloUsuario->__SET("idUsuario", $idUsuario);
  $res = $this->modeloUsuario->editarUsuario();
  return $res;
}

public function insertarU($usuario, $clave,  $nombreC, $correo, $idRol, $estado){
  $this->modeloUsuario->__SET("usuario", $usuario);
  $this->modeloUsuario->__SET("clave", md5(sha1(sha1($clave))));
  $this->modeloUsuario->__SET("nombreCompleto", $nombreC);
  $this->modeloUsuario->__SET("correo", $correo);
  $this->modeloUsuario->__SET("idRol", $idRol);
  $this->modeloUsuario->__SET("estado", $estado);
  $res = $this->modeloUsuario->insertarUsuario();
  return $res;
}

public function cambiarE($id){
  $this->modeloUsuario->__SET("idUsuario", $id);
  $res = $this->modeloUsuario->cambiarEstado();
  return $res;
}

public function eliminarU($id){
  $this->modeloUsuario->__SET("idUsuario", $id);
  $res = $this->modeloUsuario->eliminarUsuario();
  return $res;
}

public function listarRoles(){
  $roles = $this->modeloUsuario->listarRoles();
  return $roles;
}

public function joinUsC($usuario, $nombreC, $correo, $idRol, $idUsuario,
                        $fecha, $habilidades, $mensaje)
{
  $this->modeloUsuario->__SET("usuario", $usuario);
  $this->modeloUsuario->__SET("nombreCompleto", $nombreC);
  $this->modeloUsuario->__SET("correo", $correo);
  $this->modeloUsuario->__SET("idRol", $idRol);
  $this->modeloUsuario->__SET("idUsuario", $idUsuario);
  $this->modeloUsuario->__SET("bornDate", $fecha);
  $this->modeloUsuario->__SET("habilidades", $habilidades);
  $this->modeloUsuario->__SET("Mensaje", addslashes($mensaje));
  $res = $this->modeloUsuario->joinUsM();
  return $res;
}

}
?>
