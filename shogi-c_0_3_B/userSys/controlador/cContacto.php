<?php
require_once dirname(__DIR__)."/modelo/mContacto.php";
class CContacto
{

    public $modeloContacto;

    public function __construct()
    {
        $this->modeloContacto = new MContacto();
    }

    public function listarc()
    {
        $tabla = $this->modeloContacto->listarContacto();
        return $tabla;
    }
    public function paginarc($page)
    {
        $this->modeloContacto->__SET("pagina", $page);
        $tabla = $this->modeloContacto->paginarContacto();
        return $tabla;
    }
    public function eliminarc($id)
    {
        $this->modeloContacto->__SET("idContacto", $id);
        $res = $this->modeloContacto->eliminarContacto();
        return $res;
    }
}
?>