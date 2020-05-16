<?php

class Enrutador
{
    public function cargarVista($vista)
    {
        switch ($vista) {
            case 'vIdioma':
                require_once "view/" . $vista . ".php";
                break;
            case 'vInicio':
                require_once "view/" . $vista . ".php";
                break;
            case 'vDev-report':
                require_once "view/" . $vista . ".php";
                break;
            case "vNoticias":
                require_once "view/".$vista.".php";
            break;
            case "vDiseno":
                require_once "view/".$vista.".php";
            break;
            case "vContacto":
                require_once "view/".$vista."-Pub.php";
            break;
            default:
                require_once "view/notFound.php";
                break;
        }
    }
}
?>