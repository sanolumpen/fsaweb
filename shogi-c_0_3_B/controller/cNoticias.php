<?php
require_once dirname(__DIR__)."/model/mNoticias.php";
class CNoticia
{

    public $modeloNoticia;

    public function __construct()
    {
        $this->modeloNoticia = new MNoticia();
    }

    // public function validarU($user, $pass)
    // {
    //     $this->modeloNoticia->__SET("usuario", $user);
    //     $this->modeloNoticia->__SET("contrasena", md5(sha1(sha1($pass))));
    //     $res = $this->modeloNoticia->validarUsuario();
    //     return $res;
    // }

    public function descripcion($idNoticia)
    {
        $this->modeloNoticia->__SET("idNoticia", $idNoticia);
        $datos = $this->modeloNoticia->getDescipcion();
        return $datos;
    }



    public function listarN()
    {
        $tabla = $this->modeloNoticia->listarNoticias();
        return $tabla;
    }

    public function paginarN($page)
    {
        $this->modeloNoticia->__SET("pagina", $page);
        $tabla = $this->modeloNoticia->paginarNoticia();
        return $tabla;
    }

    public function editarN($idNoticia, $titulo, $descripcion, $imagen, $autor)
    {
        $this->modeloNoticia->__SET("idNoticia", $idNoticia);
        $this->modeloNoticia->__SET("titulo", $titulo);
        $this->modeloNoticia->__SET("descripcion", $descripcion);
        $this->modeloNoticia->__SET("imagen", $imagen);
        $this->modeloNoticia->__SET("autor", $autor);
        $res = $this->modeloNoticia->editarNoticia();
        return $res;
    }

    public function insertarN($title, $desc,  $imag, $creador)
    {
        $this->modeloNoticia->__SET("titulo", addslashes($title));
        $this->modeloNoticia->__SET("descripcion", addslashes($desc));
        $this->modeloNoticia->__SET("imagen", addslashes($imag));
        $this->modeloNoticia->__SET("autor", addslashes($creador));
        $res = $this->modeloNoticia->insertarNoticia();
        return $res;
    }

    public function eliminarN($id)
    {
        $this->modeloNoticia->__SET("idNoticia", $id);
        $res = $this->modeloNoticia->eliminarNoticia();
        return $res;
    }

    public function listarNTi($titulo)
    {
        $this->modeloNoticia->__SET("titulo",addslashes($titulo));
        $res = $this->modeloNoticia->listarNoticiasTi();
        return $res;
    }
    public function listarNFe($fecha)
    {
        $this->modeloNoticia->__SET("fecha",addslashes($fecha));
        $res = $this->modeloNoticia->listarNoticiasFe();
        return $res;
    }
    public function listarNTiFe($titulo,$fecha)
    {
        $this->modeloNoticia->__SET("titulo",addslashes($titulo));
        $this->modeloNoticia->__SET("fecha",addslashes($fecha));
        $res = $this->modeloNoticia->listarNoticiasFe();
        return $res;
    }
}
?>