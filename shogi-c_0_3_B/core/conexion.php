<?php

class Conexion
{
    private $host;
    private $usuario;
    private $clave;
    private $dataBase;
    private $con;

    public function __construct()
    {
        $this->host = "localhost";
        $this->usuario = "root";//"id13259597_kuraha";
        $this->clave = "";//"KurahaS_3256";
        $this->dataBase = "shogi1";//"id13259597_shogi";

        $this->con = new mysqli(
            $this->host,
            $this->usuario,
            $this->clave,
            $this->dataBase
        );
        $this->con->set_charset("utf8");

        if ($this->con->connect_error) {
            die("Hubo un error en la conexión: " . $this->con->connect_errno);
        }
    }

    public function getTable($consulta)
    {
        try {
            $sql = $this->con->query($consulta);
            return $sql;
            mysqli_close($this->con);
        } catch (Exception $e) {
            echo $e->getMessage();
            mysqli_close($this->con);
        }
    }

    public function setQuery($consulta)
    {
        try {
            $res = false;
            $sql = $this->con->query($consulta); //ejecutamos la consulta
            if ($sql) {
                $res = true;
            }
            return $res;
            mysqli_close($this->con); //cerrar conexion
        } catch (Exception $e) {
            $res= $e->getMessage();
            return $res;
            mysqli_close($this->con); //cerrar conexion
        }
    }
}
?>