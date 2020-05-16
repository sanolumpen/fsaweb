<?php
require_once dirname(__DIR__)."/modelo/mDev-report.php";
class CReport
{

    public $modeloReport;

    public function __construct()
    {
        $this->modeloReport = new MReport();
    }

    public function listarR()
    {
        $tabla = $this->modeloReport->listarReport();
        return $tabla;
    }

    public function eliminarR($id)
    {
        $this->modeloReport->__SET("idReport", $id);
        $res = $this->modeloReport->eliminarReport();
        return $res;
    }
}
?>