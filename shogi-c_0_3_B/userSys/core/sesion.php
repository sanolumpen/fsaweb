<?php

class Sesion
{
  function __construct()
  {
    session_start();//iniciar la sesion
  }

  public function cerrarSesion(){
    session_destroy();//destruir la sesion
  }
  
}

?>
