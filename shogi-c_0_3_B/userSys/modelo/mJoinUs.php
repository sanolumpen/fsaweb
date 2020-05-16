<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MJoin
{
    //atributos de la clase usuarios
    public $idJoin;
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

    
    public function listarJoin()
    {
        $sql = "SELECT *
          FROM joinus LIMIT;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    public function eliminarJoin()
    {
        $sql = "DELETE FROM joinus WHERE idJoinUs = '{$this->idReport}';";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
}
?>