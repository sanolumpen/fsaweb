<?php
require_once dirname(__DIR__)."/model/mDev-report.php";
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

    public function editarR($idReport, $titulo, $descripcion, $correo, $enlace)
    {
        $this->modeloReport->__SET("idReport", addslashes($idReport));
        $this->modeloReport->__SET("titulo", addslashes($titulo));
        $this->modeloReport->__SET("descripcion", addslashes($descripcion));
        $this->modeloReport->__SET("correo", addslashes($correo));
        $this->modeloReport->__SET("enlace", addslashes($enlace));
        $res = $this->modeloReport->editarReport();
        return $res;
    }

    public function insertarR($title, $desc,  $correo, $enlace)
    {
        $this->modeloReport->__SET("titulo", addslashes($title));
        $this->modeloReport->__SET("descripcion", addslashes($desc));
        $this->modeloReport->__SET("correo", addslashes($correo));
        $this->modeloReport->__SET("enlace", addslashes($enlace));
        $res = $this->modeloReport->insertarReport();
        return $res;
    }

    public function eliminarR($id)
    {
        $this->modeloReport->__SET("idReport", $id);
        $res = $this->modeloReport->eliminarReport();
        return $res;
    }
}
?>