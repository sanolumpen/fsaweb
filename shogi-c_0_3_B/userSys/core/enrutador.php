<?php

class Enrutador
{
 //Metodo para cargar la vista
  public function cargarVista($vista){
    switch ($vista) {
      case 'inicio':
        require_once "vista/".$vista.".php";
      break;
      case 'vGestionU':
        require_once "vista/".$vista.".php";
      break;
      case 'vCrearU-Pub':
        require_once "vista/".$vista.".php";
      break;
      case 'vNoticias':
        require_once "vista/".$vista.".php";
      break;
      case 'vGestionDi':
        require_once "vista/".$vista.".php";
      break;
      case 'vGestionReportes':
        require_once "vista/".$vista.".php";
      break;
      case 'vGestionContacto':
        require_once "vista/".$vista.".php";
      break;
      case 'pagination':
        require_once "vista/".$vista.".php";
      break;
      case 'vGestionJoinUs':
        require_once "vista/".$vista.".php";
      break;
      default:
        require_once "vista/error.php";
      break;
    }
  }
}
?>
