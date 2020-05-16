<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MDiseno
{
    //atributos de la clase usuarios
    public $idContent;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $enlace;

    //constructor para realizar la conexion
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    //Metodo set y get
    public function __SET($att, $valor)
    {
        $this->$att = $valor;
    }
    public function __GET($att)
    {
        return $this->$att;
    }
    // método para listar diseños desde la base de datos
    public function listarDiseno()
    {
        $sql = "SELECT * FROM diseno;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
    // método para insertar diseños a la base de datos
    public function insertarDiseno()
    {
        $sql = "INSERT INTO diseno(titulo, descripcion, imagen, enlace)
                VALUES('{$this->titulo}','{$this->descripcion}','{$this->imagen}',
                      '{$this->enlace}');";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
    // método para editar diseños en la base de datos
    public function editarDiseno()
    {
        $sql = "UPDATE diseno SET titulo = '{$this->titulo}',
                              descripcion = '{$this->descripcion}',
                              imagen = '{$this->imagen}',
                              enlace = '{$this->enlace}',
                               WHERE idContent = '{$this->idContent}'";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
    // método para eliminar diseños desde la base de datos
    public function eliminarDiseno()
    {
        $sql = "DELETE FROM diseno WHERE idContent = '{$this->idContent}';";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
}
?>