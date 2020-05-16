<?php
require_once dirname(__DIR__)."/modelo/mDiseno.php";
class CDiseno
{

    public $modeloDiseno;

    public function __construct()
    {
        $this->modeloDiseno = new MDiseno();
    }

    public function listarD()
    {
        $tabla = $this->modeloDiseno->listarDiseno();
        return $tabla;
    }

    public function editarD($idDiseno, $titulo, $descripcion, $imagen, $enlace)
    {
        $this->modeloDiseno->__SET("idContent", $idDiseno);
        $this->modeloDiseno->__SET("titulo", $titulo);
        $this->modeloDiseno->__SET("descripcion", addslashes($descripcion));
        $this->modeloDiseno->__SET("imagen", $imagen);
        $this->modeloDiseno->__SET("enlace", $enlace);
        $res = $this->modeloDiseno->editarDiseno();
        return $res;
    }

    public function insertarD($title, $desc,  $imag, $enlace)
    {
        $this->modeloDiseno->__SET("titulo", addslashes($title));
        $this->modeloDiseno->__SET("descripcion", addslashes($desc));
        $this->modeloDiseno->__SET("imagen", addslashes($imag));
        $this->modeloDiseno->__SET("enlace", addslashes($enlace));
        $res = $this->modeloDiseno->insertarDiseno();
        return $res;
    }

    public function eliminarD($id)
    {
        $this->modeloDiseno->__SET("idContent", $id);
        $res = $this->modeloDiseno->eliminarDiseno();
        return $res;
    }
}
?>