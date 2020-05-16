<?php

class Conexion{

private $host;
private $user;
private $pass;
private $db;
private $con;

public function __construct(){
  $this->host = "localhost";
  $this->user= "root";
  $this->pass = "";
  $this->db = "shogi1";
  $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);
  $this->con->set_charset("utf8");
  if($this->con->connect_error){
    die("Error de conexión : ".$this->con->connect_errno." ".$this->con->connect_error);
  }else{
    //echo "Conexión exitosa: ".$this->con->host_info;
  }
}
//metodo que retorne una tabla.
public function getTable($consulta){
  $res ="";
    try {
        $sql = $this->con->query($consulta);//ejecutamos la consulta
        // if($sql){
        //   $res = $sql->fetch_all(MYSQLI_ASSOC);//convertir la tabla en array asociativo
        // }else{
        //   $res ="0";
        // }
        return $sql;
        mysqli_close($this->con);//cerrar conexion
    } catch (Exception $e) {
        mysqli_close($this->con);//cerrar conexion
        echo $e->getMessage();
    }

  }

//metodo para insertar, editar y eliminar

public function setQuery($consulta){
  try {
      $res=false;
      $sql = $this->con->query($consulta);//ejecutamos la consulta
      if($sql){
        $res = true;
      }
      return $res;
      mysqli_close($this->con);//cerrar conexion
  } catch (Exception $e) {
    mysqli_close($this->con);//cerrar conexion
    echo $e->getMessage();
  }

}






}
?>
