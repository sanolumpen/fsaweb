<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MNoticia
{
    //atributos de la clase usuarios
    public $idNoticia;
    public $titulo;
    public $descripción;
    public $imagen;
    public $autor;
    public $fecha;

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

    //metodo para listar noticias
    public function listarNoticias()
    {
        $sql = "SELECT *
          FROM noticias;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    //metodo para insertar usuarios
    public function insertarNoticia()
    {
        $sql = "INSERT INTO noticias(titulo, descripcion, imagen, autor, fecha)
                VALUES('{$this->titulo}','{$this->descripcion}','{$this->imagen}',
                      '{$this->autor}',CURDATE());";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }

    // metodo para editar Noticias.
    public function editarNoticia()
    {
        $sql = "UPDATE noticias SET titulo = '{$this->titulo}',
                              descripcion = '{$this->descripcion}',
                              imagen = '{$this->imagen}',
                              autor = '{$this->autor}',
                               WHERE idNoticia = '{$this->idNoticia}'";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }

    //metodo para eliminar noticias
    public function eliminarNoticia()
    {
        $sql = "DELETE FROM noticias WHERE idNoticia = '{$this->idNoticia}';";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }

    //crear metodo paar retornar los datos del usuario
    public function getDescipcion()
    {
        $sql = "SELECT descripcion
           FROM accesos WHERE idNoticia = '{$this->idNoticia}';";
        $data = $this->conexion->getTable($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    //filtra las noticias por título
    public function listarNoticiasTi()
    {
        $sql = "SELECT *
          FROM noticias WHERE titulo = '{$this->titulo}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
    //Filtra las noticias por fecha
    public function listarNoticiasFe()
    {
        $sql = "SELECT *
          FROM noticias WHERE fecha = '{$this->fecha}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
    //Filtra las noticias por ambus
    public function listarNoticiasTiFe()
    {
        $sql = "SELECT *
          FROM noticias WHERE fecha = '{$this->fecha}' AND titulo = '{$this->titulo}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
}
?>