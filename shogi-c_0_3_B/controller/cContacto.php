<?php
require_once dirname(__DIR__)."/model/mContacto.php";
class CContacto
{

    public $modeloContacto;

    public function __construct()
    {
        $this->modeloContacto = new MContacto();
    }

    public function listarR()
    {
        $tabla = $this->modeloContacto->listarContacto();
        return $tabla;
    }

    public function editarR($idContacto, $titulo, $descripcion, $correo, $nombreC)
    {
        $this->modeloContacto->__SET("idContacto", addslashes($idContacto));
        $this->modeloContacto->__SET("titulo", addslashes($titulo));
        $this->modeloContacto->__SET("descripcion", addslashes($descripcion));
        $this->modeloContacto->__SET("correo", addslashes($correo));
        $this->modeloContacto->__SET("nombreC", addslashes($nombreC));
        $res = $this->modeloContacto->editarContacto();
        return $res;
    }

    public function insertarR($title, $desc,  $correo, $nombreC)
    {
        $this->modeloContacto->__SET("titulo", addslashes($title));
        $this->modeloContacto->__SET("descripcion", addslashes($desc));
        $this->modeloContacto->__SET("correo", addslashes($correo));
        $this->modeloContacto->__SET("nombreC", addslashes($nombreC));
        $res = $this->modeloContacto->insertarContacto();
        return $res;
    }

    public function eliminarR($id)
    {
        $this->modeloContacto->__SET("idContacto", $id);
        $res = $this->modeloContacto->eliminarContacto();
        return $res;
    }
}
?>