<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MContacto
{
    //atributos de la clase usuarios
    public $idContacto;
    public $nombreC;
    public $titulo;
    public $descripcion;
    public $correo;
    public $conexion;

    //this constructor makes the conextion with database
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function __SET($att, $valor)
    {
        $this->$att = $valor;
    }
    public function __GET($att)
    {
        return $this->$att;
    }

    
//the CRUD services
    public function listarContacto()
    {
        $sql = "SELECT *
          FROM contacto;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    public function insertarContacto()
    {
        $sql = "INSERT INTO contacto(nombreC, titulo, descripcion, correo)
                VALUES('{$this->nombreC}','{$this->titulo}','{$this->descripcion}','{$this->correo}');";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }

    public function editarContacto()
    {
        $sql = "UPDATE contacto SET titulo = '{$this->titulo}',
                              descripcion = '{$this->descripcion}',
                              correo = '{$this->correo}',
                              nombreC = '{$this->nombreC}'
                               WHERE idContacto = '{$this->idContacto}'";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }

    public function eliminarContacto()
    {
        $sql = "DELETE FROM contacto WHERE idContacto = '{$this->idContacto}';";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
}
?>