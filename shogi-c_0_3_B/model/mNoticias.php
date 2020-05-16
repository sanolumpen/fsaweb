<?php
require_once dirname(__DIR__)."/core/conexion.php";
class MNoticia
{
    //class vars
    public $idNoticia;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $autor;
    public $fecha;
    public $pagina;

    //constructor makes the conection with database
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

    //metodo validar usuario
    // public function validarUsuario()
    // {
    //     $sql = "SELECT * FROM accesos WHERE usuario = '{$this->usuario}' AND
    //     contrasena = '{$this->contrasena}';";
    //     $query = $this->conexion->getTable($sql);
    //     $user = mysqli_num_rows($query);
    //     if ($user > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    //CRUD services
    public function listarNoticias()
    {
        $sql = "SELECT *
          FROM noticias;";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    //this Method makes paginable this section
    public function paginarNoticia()
    {
        $sql = "SELECT * FROM noticias LIMIT {$this->pagina} ";
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

    //that method returns the description of the new
    public function getDescipcion()
    {
        $sql = "SELECT descripcion
           FROM accesos WHERE idNoticia = '{$this->idNoticia}';";
        $data = $this->conexion->getTable($sql);
        $row = mysqli_fetch_assoc($data);
        return $row;
    }
    //filter news by title
    public function listarNoticiasTi()
    {
        $sql = "SELECT *
          FROM noticias WHERE titulo = '{$this->titulo}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
    // filter news by time
    public function listarNoticiasFe()
    {
        $sql = "SELECT *
          FROM noticias WHERE fecha = '{$this->fecha}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }

    public function listarNoticiasTiFe()
    {
        $sql = "SELECT *
          FROM noticias WHERE fecha = '{$this->fecha}' AND titulo = '{$this->titulo}';";
        $tabla = $this->conexion->getTable($sql);
        return $tabla;
    }
}
?>