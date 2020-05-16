<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MUsuario{
//atributos de la clase usuarios
public $idUsuario;
public $usuario;
public $clave;
public $nombreCompleto;
public $correo;
public $idRol;
public $estado;
//variables de clase para peticiones de participación.
public $bornDate;
public $habilidades;
public $Mensaje;
//Variable de clase para instanciar el obj conexion.
public $conexion;

//constructor para realizar la conexion
public function __construct(){
  $this->conexion = new Conexion();
}
//Metodo set y get
public function __SET($att, $valor){
  $this->$att = $valor;
}
public function __GET($att){
 return $this->$att;
}

//metodo validar usuario
public function validarUsuario(){
  $sql = "SELECT * FROM usuarios WHERE Usuario = '{$this->usuario}' AND
  Clave = '{$this->clave}' AND Estado = 1 LIMIT 1;";
  $query = $this->conexion->getTable($sql);
  $user = mysqli_num_rows($query);
  if($user > 0){
    return true;
  }else{
    return false;
  }
}

//metodo para listar los usuarios
public function listarUsuarios(){
  $sql = "SELECT U.IdUsuario, U.NombreCompleto, U.Usuario, U.Correo, U.Estado, U.IdRol, R.Rol
          FROM usuarios AS U
          INNER JOIN roles AS R ON U.IdRol = R.IdRol;";
  $tabla = $this->conexion->getTable($sql);
  return $tabla;
}

//metodo para listar los roles
public function listarRoles(){
  $sql = "SELECT * FROM roles;";
  $roles = $this->conexion->getTable($sql);
  return $roles;
}

//metodo para insertar usuarios
public function insertarUsuario(){
  $sql = "INSERT INTO usuarios(Usuario, Clave, NombreCompleto, Correo, IdRol, Estado)
          VALUES('{$this->usuario}','{$this->clave}','{$this->nombreCompleto}',
                '{$this->correo}','{$this->idRol}', '{$this->estado}');";
  $res = $this->conexion->setQuery($sql);
  return $res;
}
//metodo para editar usuario.
public function editarUsuario(){
  $sql = "UPDATE usuarios SET Usuario = '{$this->usuario}',
                              NombreCompleto = '{$this->nombreCompleto}',
                              Correo = '{$this->correo}',
                              IdRol = '{$this->idRol}'
                               WHERE IdUsuario = '{$this->idUsuario}'";
  $res = $this->conexion->setQuery($sql);
  return $res;
}
//metodo para cambiar estado del usuario
public function cambiarEstado(){
  $sql = "UPDATE usuarios SET Estado = (CASE WHEN Estado = 1 THEN 0 ELSE 1 END)
          WHERE IdUsuario = '{$this->idUsuario}';";
  $res = $this->conexion->setQuery($sql);
  return $res;
}

//metodo para eliminar usuario
public function eliminarUsuario(){
  $sql ="DELETE FROM usuarios WHERE IdUsuario = '{$this->idUsuario}';";
  $res = $this->conexion->setQuery($sql);
  return $res;
}

//crear metodo paar retornar los datos del usuario
public function getDatosUsuario(){
  $sql = "SELECT *
           FROM usuarios WHERE Usuario = '{$this->usuario}' AND Clave='{$this->clave}';";
  $data = $this->conexion->getTable($sql);
  $row = mysqli_fetch_assoc($data);
  return $row;
}
//Esta función agrega los datos de la petición al registro correspondiente al usuario
public function joinUsM()
{
  $sql = "UPDATE usuarios SET Usuario = '{$this->usuario}',
                              NombreCompleto = '{$this->nombreCompleto}',
                              Correo = '{$this->correo}',
                              IdRol = '{$this->idRol}',
                              nacimiento = '{$this->bornDate}',
                              habilidades ='{$this->habilidades}',
                              mensaje = '{$this->Mensaje}' 
                              WHERE IdUsuario = '{$this->idUsuario}'";
  $res = $this->conexion->setQuery($sql);
  return $res;
}

}
?>
