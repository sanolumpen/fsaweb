<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MReport
{
    //atributos de la clase usuarios
    public $idReport;
    public $titulo;
    public $descripcion;
    public $correo;
    public $enlace;
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
    public function listarReport()
    {
        $sql = "SELECT *
          FROM devreport;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    public function eliminarReport()
    {
        $sql = "DELETE FROM devreport WHERE idReport = '{$this->idReport}';";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
}
?>