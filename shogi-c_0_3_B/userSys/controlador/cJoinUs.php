<?php
require_once dirname(__DIR__)."/modelo/mDev-report.php";
class CReport
{

    public $modeloJoinUs;

    public function __construct()
    {
        $this->modeloJoinUs = new MJoin();
    }

    public function listarJ()
    {
        $tabla = $this->modeloJoinUs->listarJoin();
        return $tabla;
    }

    public function eliminarJ($id)
    {
        $this->modeloJoinUs->__SET("idJoin", $id);
        $res = $this->modeloJoinUs->eliminarJoin();
        return $res;
    }
}
?>